export function objectToFormData(object, formDataOld = null, keyOld = null) {
    let formData = formDataOld ?? new FormData();

    for (var key in object) {
        let value = object[key];

        if (keyOld) {
            key = `${keyOld}[${key}]`;
        }

        if (value instanceof File) {
            formData.append(key, value, value.name);
            continue;
        }

        if (value instanceof Object) {
            this.objectToFormData(value, formData, key);
            continue;
        }

        formData.append(key, value);
    }

    return formData;
};