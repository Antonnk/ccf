function secondsToHMS(secs) {
    function pad(n) {
        return (n < 10 ? '0' : '') + n;
    }

    var sign = secs < 0 ? '-' : '';
    secs = Math.abs(secs);
    return sign + pad(secs / 3600 | 0) + ':' + pad((secs % 3600) / 60 | 0) + ':' + pad(Math.round(secs % 60));
}

export {secondsToHMS}
