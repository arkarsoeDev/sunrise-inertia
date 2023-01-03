const isMobile = function () {
   return window.innerWidth < 640;
}

const formatDate = function (data) {
    let newDate = new Date(data * 1000);
    return `${newDate.getDate()} / ${
        newDate.getMonth() + 1
    } / ${newDate.getFullYear()}`;
};

const timestampForLara = function (date) {
    return Math.floor(date.getTime() / 1000);
}

export { isMobile,formatDate, timestampForLara }