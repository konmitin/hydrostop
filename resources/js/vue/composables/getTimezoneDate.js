export function currentTimezoneDate(date) {
    let currentDate = new Date();
    let newDate = date ? new Date(date) : new Date();

    newDate.setTime(newDate.getTime() - currentDate.getTimezoneOffset() * 60 * 1000);

    return newDate;
}