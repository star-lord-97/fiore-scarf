module.exports = {
    purge: false,
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: { inter: ["Inter"] },
        },
    },
    variants: {
        extend: {
            display: ["group-hover"],
            transitionProperty: ["group-hover"],
            opacity: ["disabled"],
            cursor: ["disabled"],
        },
    },
    plugins: [],
};
