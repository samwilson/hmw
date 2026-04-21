document.querySelectorAll('.access-date').forEach( ( el ) => {
    const options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    };
    el.innerText = 'Access date: ' + ( new Date() ).toLocaleDateString(undefined, options) + '.';
} );
