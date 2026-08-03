
import { $ } from 'jquery';
import Swiper from 'swiper';
import { Navigation, Scrollbar } from 'swiper/modules';
import { setupPhoneFormatting, site } from './functions';
import { openNotificationModal } from './forms';

if (!site.branchId || site.branchId <= 0) {
    site.getActivebranch();
} else {
    site.setbranchId(site.branchId);
}

let order = {
    selectedDate: null,
    selectedTime: null,
    clientType: "without",
    package: {
        name: '',
        code: '',
        price: 0,
    },
    addons: [],
    discount: 0,
    miles: 0,
    milePrice: 2, // need req for branch
    milesAmount: 0,
    vehicleCount: 1,
    zip: null,
    isBlocked: false,
    lastError: "",
    setPackage(code, price, name) {
        this.package.name = name;
        this.package.code = code;
        this.package.price = price;

        setInspectionPackage(this.package);
        changeInspectionTotal();
        toggleVisibleFormFields();
    },
    setClientType(type) {
        this.clientType = type;

        toggleVisibleFormFields();
    },
    setMiles(number) {
        this.miles = Math.ceil(number);

        order.setMilesAmount(this.miles * site.branch.mile_price);

        changeInspectionMiles();
        changeInspectionTotal();
    },
    setMilesAmount(amount) {
        this.milesAmount = amount;
    },
    incVehicleCount() {
        this.vehicleCount++;

        changeInspectionTotal();

        return this.vehicleCount;
    },
    decVehicleCount() {
        this.vehicleCount--;

        if (this.vehicleCount == 0) {
            this.vehicleCount = 1;
        }

        changeInspectionTotal();

        return this.vehicleCount;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Мобильное меню
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Плавная прокрутка к якорям
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });

                // Закрыть мобильное меню после клика
                if (mobileMenu) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });

    // Обработка кнопок "Сделать заказ"
    const orderButtons = document.querySelectorAll('.product-card button');
    orderButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Здесь можно добавить логику открытия формы заказа
            alert('Форма заказа будет открыта в модальном окне');
        });
    });

    // PHONE INPUTS
    const phoneInputs = document.querySelectorAll('input[type="tel"]');

    if (phoneInputs) {
        phoneInputs.forEach(input => {
            setupPhoneFormatting(input);
        });
    }
});

$(document).ready(function () {
});

function onSubmitInspectionForm(event) {
    event.preventDefault();
    $('#submit-order').prop("disabled", true);
    openNotificationModal('Please, wait');


    if (order.isBlocked) {
        openNotificationModal(order.lastError, 'error');
        $('#submit-order').prop("disabled", false);
    }

    let form = event.target;
    let formBody = {
        vehicles: [],
        inspectionDate: null
    };

    // FIELDS
    const requiredFields = form.querySelectorAll('[data-input-required]');
    let allRequiredFilled = true;
    let missingFields = [];

    requiredFields.forEach(field => {
        if (field && !field.value.trim()) {
            allRequiredFilled = false;
            missingFields.push(field.parentNode.querySelector('label').textContent.replace('*', '').trim());
        }
    });

    if (!allRequiredFilled) {
        openNotificationModal(`Please fill in all required fields: ${missingFields.join(', ')}`, 'error');  // need notify
        $('#submit-order').prop("disabled", false);
        return;
    }

    const inputs = form.querySelectorAll('input, textarea, select');

    inputs.forEach(input => {
        let inputNameArr = input.name.split('-');
        let inputNameStr = '';

        inputNameArr.forEach((inputName, i) => {
            if (i == 0) {
                inputNameStr += inputName;
            } else {
                inputNameStr += inputName.charAt(0).toUpperCase() + inputName.slice(1);
            }
        });

        formBody[inputNameStr] = input.value;
    });

    let inspectionDate;
    if (order.clientType == 'with' || order.type == 'full') {
        if (!order.selectedDate || !order.selectedTime) {
            openNotificationModal('TIME IS NOT DEFINED!', 'error');
            $('#submit-order').prop("disabled", false);
            return;
        }

        inspectionDate = new Date(`${order.selectedDate.getMonth() + 1}/${order.selectedDate.getDate()}/${order.selectedDate.getFullYear()} ${order.selectedTime[0].value}`);
        formBody['inspectionDateUTCUNIX'] = inspectionDate.getTime() / 1000;
        formBody['inspectionDateTimeZone'] = (inspectionDate.getTime() - (new Date().getTimezoneOffset() * 60 * 1000)) / 1000;
    }

    // VEHICLES
    const vehicles = document.querySelector('#vehicles').children;

    for (const key in vehicles) {
        if (!Object.hasOwn(vehicles, key)) continue;

        const vehicle = vehicles[key];

        const inputYear = vehicle.querySelector(`[data-vehicle-year='${vehicle.id}']`);
        const inputVin = vehicle.querySelector(`[data-vehicle-vin='${vehicle.id}']`);
        const inputAskingPrice = vehicle.querySelector(`[data-vehicle-asking-price='${vehicle.id}']`);

        const selectMake = $(vehicle).find(`[data-vehicle-make=${vehicle.id}]`).select2('data')[0];
        const selectModel = $(vehicle).find(`[data-vehicle-model=${vehicle.id}]`).select2('data')[0];

        let vehicleObj = {
            year: inputYear.value,
            vin: inputVin.value,
            askingPrice: inputAskingPrice.value,
            make: {
                id: selectMake.id,
                name: selectMake.text
            },
            model: {
                id: selectModel.id,
                name: selectModel.text
            },
        }

        if (!vehicleObj.year || !vehicleObj.make.name || !vehicleObj.model.name) {
            openNotificationModal("Fill in the year make and model fields for all vehicles", 'error');
            $('#submit-order').prop("disabled", false);
            return;
        }

        formBody['vehicles'].push(vehicleObj);
    }

    // COORDINATES
    formBody['zip'] = order.zip;

    formBody['distanceToAddress'] = order.miles;

    formBody['vehicleAddressLat'] = form.querySelector('[data-address-lat]').getAttribute('data-address-lat');
    formBody['vehicleAddressLong'] = form.querySelector('[data-address-long]').getAttribute('data-address-long');

    if (!formBody['vehicleAddressLat'] || !formBody['vehicleAddressLong']) {
        // alert('The Vehicle Address is not filled in correctly. Enter the address in the field and select from the available options');
        // return;
    }

    // TERMS
    const termsCheckbox = document.getElementById('terms');
    if (!termsCheckbox.checked) {
        openNotificationModal('You must agree to the Terms and Conditions before submitting.', 'error');
        $('#submit-order').prop("disabled", false);
        return;
    }

    const resAddOrder = fetch(`/booking/inspection/order?_token=${site.csrf}`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formBody)
    }).then(res => {
        return res.json();
    }).then(res => {
        let paymentLink = res.data.payment_link;

        if (paymentLink) {
            window.location.assign(paymentLink);
        } else {
            openNotificationModal('Payments is not defined', 'error');  // need notify
        }
    }).catch(res => {
        openNotificationModal('Undefined error', 'error');
    });

    // Show success message // need notify
}

function onSubmitSelectionForm(event) {
    event.preventDefault();

    if (order.isBlocked) {
        openNotificationModal(order.lastError, 'error');
    }

    let form = event.target;
    let formBody = {};

    // FIELDS
    const requiredFields = form.querySelectorAll('[data-input-required]');
    let allRequiredFilled = true;
    let missingFields = [];

    requiredFields.forEach(field => {
        if (field && !field.value.trim()) {
            allRequiredFilled = false;

            let parentField = field.parentNode;
            while (!parentField.querySelector('label')) {
                parentField = parentField.parentNode;
            }

            missingFields.push(parentField.querySelector('label').textContent.replace('*', '').trim());
        }
    });

    if (!allRequiredFilled) {
        openNotificationModal(`Please fill in all required fields: ${missingFields.join(', ')}`, 'error');  // need notify
        return;
    }

    const inputs = form.querySelectorAll('input, textarea, select');

    inputs.forEach(input => {
        let inputNameArr = input.name.split('-');
        let inputNameStr = '';

        inputNameArr.forEach((inputName, i) => {
            if (i == 0) {
                inputNameStr += inputName;
            } else {
                inputNameStr += inputName.charAt(0).toUpperCase() + inputName.slice(1);
            }
        });

        formBody[inputNameStr] = input.value;
    });

    // TERMS
    const termsCheckbox = document.getElementById('terms');
    if (!termsCheckbox.checked) {
        openNotificationModal('You must agree to the Terms and Conditions before submitting.', 'error');
        return;
    }

    $('#submit-order').prop("disabled", true);

    const resAddOrder = fetch(`/booking/selection/order?_token=${site.csrf}`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formBody)
    }).then(res => {
        return res.json();
    }).then(res => {
        if (res.status == "success") {
            openNotificationModal('Selection sumbited', 'success');

        } else {
            openNotificationModal('Unknow error', 'error');
        }

        // $('#submit-order').prop("disabled", false);

    }).catch(res => {
        console.log(res);
    });

    // Show success message // need notify
}

//  VEHICLE

function addVehicleEvent(event) {
    let count = order.incVehicleCount();

    const vehicleList = document.querySelector('#vehicles');
    const makes = document.querySelector('#vehicle-1-make');

    let options = ``;

    for (const key in makes.children) {
        if (!Object.hasOwn(makes.children, key)) continue;
        const child = makes.children[key];
        options += child.outerHTML;
    }

    const newVehicle = `<div id="vehicle-${count}" class="relative">
                            <h3 class="font-bold text-lg uppercase mb-2 text-orange-600">Vehicle ${count}</h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="vehicle-${count}-year" class="form-label required">Vehicle Year</label>
                                    <input data-vehicle-year="vehicle-${count}" type="text" name="vehicle-${count}-year" id="vehicle-${count}-year" class="form-input"
                                        placeholder="e.g. 2006">
                                </div>

                                <div>
                                    <label for="vehicle-${count}-make" class="form-label required">
                                        Vehicle Make
                                    </label>
                                    <select data-vehicle-make="vehicle-${count}" type="text" name="vehicle-${count}-make" id="vehicle-${count}-make" class="w-full form-input"
                                        placeholder="e.g. Ford">
                                        ${options}
                                    </select>
                                </div>

                                <div>
                                    <label for="vehicle-${count}-model" class="form-label required">Vehicle Model</label>

                                    <select data-vehicle-model="vehicle-${count}" type="text" name="vehicle-${count}-model" id="vehicle-${count}-model" class="form-input"
                                        placeholder="e.g. Ford">
                                        <option value="" selected disabled>Сhoose a make</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="vin" class="form-label">VIN (optional)</label>
                                    <input data-vehicle-vin='vehicle-${count}' type="text" name="vehicle-${count}-vin" id="vehicle-${count}-vin" class="form-input"
                                        placeholder="VIN (Optional)">
                                </div>


                                <div>
                                    <label for="asking-price" class="form-label">Seller Asking Price (optional)</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">$</span>
                                        </div>
                                        <input data-vehicle-asking-price='vehicle-${count}' type="number" name="vehicle-${count}-asking-price" id="vehicle-${count}-asking-price"
                                            class="form-input !pl-8" placeholder="(Optional)">
                                    </div>
                                </div>
                            </div>

                            <button type="button" data-vehicle-delete="vehicle-${count}"
                                class="text-md absolute right-0 bottom-0 cursor-pointer text-red-500 hover:text-red-700">
                                Delete <i class="fa fa-trash ml-1"></i>
                            </button>
                        </div>`;

    vehicleList.insertAdjacentHTML('beforeend', newVehicle);

    $('[data-vehicle-delete]').off('click').on('click', deleteVehicleEvent);

    $('[data-vehicle-make]').select2({ width: 'style', tags: true });
    $('[data-vehicle-model]').select2({ width: 'style', tags: true });

    $('[data-vehicle-make]').on('change', onChangeVehicleMake);
}

function deleteVehicleEvent(event) {
    let count = order.decVehicleCount();

    const deleteBtn = event.currentTarget;

    const vehicle = document.querySelector('#' + deleteBtn.getAttribute('data-vehicle-delete'));

    vehicle.remove();
}
// Client

async function loginClientSubmit(event) {
    event.preventDefault();

    let form = event.target;

    let body = {
        email: form.querySelector('input[name="email"]').value,
        password: form.querySelector('input[name="password"]').value,
    }

    const response = await fetch(`/client/login?_token=${site.csrf}`, {
        method: 'POST',
        body: JSON.stringify(body),
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        }
    }).then(res => {
        return res.json();
    }).then(res => {
        if (res.errors) {
            for (const key in res.errors) {
                if (!Object.hasOwn(res.errors, key)) continue;

                const error = res.errors[key];

                openNotificationModal(error, 'error');
            }

            return res;
        }
        if (res.url) {
            window.location.assign(res.url);
        }
    });
}

$('#password-show').on('click', function () {
    const input = document.getElementById('password');
    const icon = document.getElementById('password-icon');

    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';

    icon.className = isPassword ? 'fas fa-eye-slash' : 'fas fa-eye';
    this.setAttribute('aria-label', isPassword ? 'Скрыть пароль' : 'Показать пароль');
});

// Inspection

function resetInspectionForm(sayConfirm = false) {
    if (sayConfirm && !confirm(
        'Are you sure you want to reset the form? All entered data will be lost.')) {
        return;
    }

    const formInputs = document.querySelectorAll('input, textarea, select');
    formInputs.forEach(input => {
        if (input.type === 'checkbox' || input.type === 'radio') {
            input.checked = false;
        } else if (input.hasAttribute('data-inspection-type')) {
            input.value = 'single';
        } else {
            input.value = '';
        }

        input.dispatchEvent(new Event('change'));
    });

    const addonCards = document.querySelectorAll('.addon-card');
    addonCards.forEach(card => {
        card.classList.remove('selected');
    });

    if (sayConfirm) {
        alert('Form has been reset.');
    }
}

function makeInputVehicleCounter() {

    let num = 0;

    return function (callback, event) {
        num += 1;

        setTimeout(() => {
            num -= 1

            if (num <= 0) {
                callback(event);
            }
        }, 300);

        return num;
    }
}

// ADDRESS

let inputVehicleAddresCounter = makeInputVehicleCounter();

function onChangeVehicleAddress(jqEvent) {
    let target = jqEvent.currentTarget;

    if (!target.value) {
        return;
    }

    const response = fetch(`/geoapify/address?text=${target.value}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        }
    }).then((res) => {
        return res.json();
    }).then((res) => {
        currentAddresses = res.data.features;
        renderAddressDropdown();
    }).catch(res => {
        currentAddresses = [
            {
                properties: {
                    formatted: target.value,
                    postcode: 0
                },
                geometry: {
                    coordinates: [0, 0]
                }
            }
        ];
        renderAddressDropdown();
    });
}

function renderAddressDropdown() {
    if (!currentAddresses.length) {
        vehicleAddressDropdown.classList.remove('show');
        return;
    }

    vehicleAddressDropdown.innerHTML = ''; // очистка

    currentAddresses.forEach((addr, idx) => {
        let item = document.createElement('div');


        item.className = 'vehicle-address-dropdown-item';

        if (idx === selectedVehicleAddressIndex) {
            item.classList.add('active');
        }

        item.textContent = addr.properties.formatted;

        item.setAttribute('data-index', idx);

        item.addEventListener('click', function () {
            selectAddress(addr);

            vehicleZipInput.value = addr.properties.postcode;
            order.zip = addr.properties.postcode;
        });

        vehicleAddressDropdown.appendChild(item);


    });

    vehicleAddressDropdown.classList.add('show');
}

function onKeydownVehicleAddress(e) {
    if (!vehicleAddressDropdown.classList.contains('show')) return;

    if (e.key === 'ArrowDown') {
        e.preventDefault();
        if (currentAddresses.length > 0) {
            selectedVehicleAddressIndex = (selectedVehicleAddressIndex + 1) % currentAddresses.length;
            renderAddressDropdown(currentAddresses);
        }
    } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        if (currentAddresses.length > 0) {
            selectedVehicleAddressIndex = (selectedVehicleAddressIndex - 1 + currentAddresses.length) % currentAddresses.length;
            renderAddressDropdown(currentAddresses);
        }
    } else if (e.key === 'Enter') {
        e.preventDefault();
        if (selectedVehicleAddressIndex >= 0 && selectedVehicleAddressIndex < currentAddresses.length) {
            selectAddress(currentAddresses[selectedVehicleAddressIndex]);
        }
    } else if (e.key === 'Escape') {
        hideAddressDropdown();
    }
}

function onBlurVehicleAddress() {
    setTimeout(() => {
        if (!vehicleAddressDropdown.contains(document.activeElement)) {
            // hideAddressDropdown();
        }
    }, 200);
}

function onClickOutsideVehicleAddressDropdown(e) {
    if (!vehicleAddressInput.contains(e.target) && !vehicleAddressDropdown.contains(e.target)) {
        // hideAddressDropdown();
    }
}

function hideAddressDropdown() {
    console.log(222);
    vehicleAddressDropdown.classList.remove('show');
    selectedVehicleAddressIndex = -1; // сброс активного индекса
}

async function selectAddress(address) {

    vehicleAddressInput.setAttribute('data-address-long', address.geometry.coordinates[0]);
    vehicleAddressInput.setAttribute('data-address-lat', address.geometry.coordinates[1]);

    vehicleAddressInput.value = address.properties.formatted;
    vehicleAddressDropdown.classList.remove('show');
    selectedVehicleAddressIndex = -1; // сброс активного индекса

    let latAddress = address.geometry.coordinates[1];
    let longAddress = address.geometry.coordinates[0];

    let distance = await calculateDistance(latAddress, longAddress);

    let radius = site.branch.radius;
    let radiusMax = site.branch.max_radius;


    if (distance >= radiusMax && radiusMax > 0) {
        order.setMiles(0);
        order.isBlocked = true;
        order.lastError = "Your request is outside our service area. Please chat or call us to get a custom quote";
        openNotificationModal(order.lastError, 'error');
    } else if (distance > radius) {
        order.isBlocked = false;
        order.setMiles(distance - radius);
    } else {
        order.isBlocked = false;
        order.setMiles(0);
    }

    hideAddressDropdown();
}

/**
 * Рассчитывает расстояние между двумя точками на Земле
 * @param {number} lat - Latitude sources point in grad
 * @param {number} lon - Longitude sources point in grad
 * @param {string} unit - km or miles
 * @returns {number} - Расстояние
 */
async function calculateDistance(lat, lon, unit = 'miles') {
    const R = unit === 'miles' ? 3958.8 : 6371; // Радиус Земли (мили или км)
    const body = {
        targets: {
            lon: lon,
            lat: lat,

        },
        unit: unit
    }

    const response = await fetch(`/geoapify/route/distance?_token=${site.csrf}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(body)
    });

    if (response.ok) {
        let result = await response.json();

        return Number(result.data);

    } else {
        console.log(response.errors);
    }

    return 0;
}
