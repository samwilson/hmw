const options = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
};
document.querySelectorAll('.access-date').forEach( ( el ) => {
    el.innerText = 'Access date: ' + ( new Date() ).toLocaleDateString(undefined, options) + '.';
} );
document.querySelectorAll('.tpl-item-cite-date time[data-date-precision="day"]').forEach( ( el ) => {
    el.innerText = ( new Date( el.dateTime ) ).toLocaleDateString(undefined, options);
} );

document.getElementById('search-form').remove();
