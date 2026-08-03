import { $ } from 'jquery';
import { site } from './functions';
import axios from 'axios';

$('#questionForm').off('submit').on('submit', function (e) {
    e.preventDefault();

    let form = $(e.currentTarget);
    submitContactForm(form);
});

let textThanks = 'Спасибо! Наши сотрудники свяжутся с вами в ближайшее время!';

async function submitContactForm(form) {

    let fields = form.find('input, textarea');

    let body = {
        name,
        company_name,
        email,
        phone,
        comment,
    }

    fields.each((i, field) => {
        body[field.name] = field.value;
    });

    let response = await axios.post(`/public/calls?_token=${site.csrf}`, body).then(res => {

        $('#questionForm').trigger('reset');
        closeQuestionFormModal();

        openNotificationModal(textThanks, 'success');
    }).catch(error => {
        let data = error.response.data;

        if (data.errors) {
            for (const key in data.errors) {
                if (!Object.hasOwn(data.errors, key)) continue;

                const error = data.errors[key];

                openNotificationModal(error[0], "error", 3500);
            }
        } else if (data.message) {
            openNotificationModal(data.message, "error", 3500);
        }
    });
}

let questionWrapper = $('.question__wrapper_modal');

$('#questionVisible').off('click').on('click', function () {
    questionWrapper.removeClass('hidden');
});

$('#questionUnvisible').off('click').on('click', function () {
    closeQuestionFormModal();
});

$('#questionFormWrapper').off('click').on('click', function (e) {

    if (e.target.closest('#questionForm')) {
        return;
    }

    closeQuestionFormModal();
});

function closeQuestionFormModal() {
    questionWrapper.addClass('hidden');
}

export function openNotificationModal(text, type, timeout = 3000) {

    let icon = 'fa ';

    switch (type) {
        case 'success':
            icon += 'fa-check-circle';
            break;
        case 'error':
            icon += 'fa-exclamation-circle';
            break;
        case 'info':
            icon += 'fa-info-circle';
            break;
        default:
            icon += 'fa-info-circle';
            break;
    }


    $('#notificationIcon').removeClass();
    $('#notificationIcon').addClass(icon);

    $('#notificationContent').removeClass('error');
    $('#notificationContent').removeClass('info');
    $('#notificationContent').addClass(type);

    $('#notificationWrapper').addClass('active');
    $('#notificationContentText').text(text);

    setTimeout(() => {
        $('#notificationWrapper').removeClass('active');
        $('#notificationContent').textContent = '';
    }, timeout);
}