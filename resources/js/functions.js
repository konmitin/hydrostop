import axios from "axios";

export const site = {
    csrf: document.querySelector('input[name="_token"]').value,
    branchId: 0,
    branch: {},
    setbranchData(data) {
        this.branch = data;
    },
    async getActivebranch() {
        const response = await axios.get(`/public/branches/active`).then((res) => {
            site.setbranchData(res.data.data);
            site.branchId = res.data.data.id;
        }).catch((res) => {
            console.log(res);
        });
    },
    async setbranchId(branchId) {
        const response = await axiosюзщые(`/public/branches/active/${branchId}?_token=${site.csrf}`).then((res) => {
            site.setbranchData(res.data);
            site.branchId = res.data.id;
        }).catch((res) => {
            console.log(res);
        });
    }
}


export function setupPhoneFormatting(inputElement) {
    const prefixNumber = (str) => {

        if (str === "7") {
            return "7 (";
        }

        if (str === "8") {
            return "+7 (";
        }

        if (str === "9") {
            return "7 (9";
        }

        return "7 (";
    };

    const formatPhone = (value) => {
        value = value.replace(/\D+/g, "");
        const numberLength = 11;

        let result;

        if (value.includes("+8") || inputElement.value[0] === "8") {

            result = "";
        } else if (value.length > 1) {
            result = "+";
        } else {
            result = "";
        }

        for (let i = 0; i < value.length && i < numberLength; i++) {
            switch (i) {
                case 0:

                    result += prefixNumber(value[i]);
                    continue;
                case 4:

                    result += ") ";
                    break;
                case 7:

                    result += "-";
                    break;
                case 9:

                    result += "-";
                    break;
                default:
                    break;
            }

            result += value[i];
        }

        return result;
    }

    inputElement.value = formatPhone(inputElement.value);

    inputElement.addEventListener('input', (e) => {

        const start = inputElement.selectionStart;
        const end = inputElement.selectionEnd;
        const oldValue = inputElement.value;
        const newValue = formatPhone(oldValue);

        if (oldValue !== newValue) {
            inputElement.value = newValue;

            // Корректируем позицию курсора
            const diff = newValue.length - oldValue.length;
            const newPosition = start + diff;
            inputElement.setSelectionRange(newPosition, newPosition);
        }
    });
};