import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import containerQueries from '@tailwindcss/container-queries';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                "label-md": ["Inter", ...defaultTheme.fontFamily.sans],
                "body-md": ["Inter", ...defaultTheme.fontFamily.sans],
                "headline-lg-mobile": ["Plus Jakarta Sans", ...defaultTheme.fontFamily.sans],
                "display-lg-mobile": ["Plus Jakarta Sans", ...defaultTheme.fontFamily.sans],
                "display-lg": ["Plus Jakarta Sans", ...defaultTheme.fontFamily.sans],
                "label-sm": ["Inter", ...defaultTheme.fontFamily.sans],
                "body-lg": ["Inter", ...defaultTheme.fontFamily.sans],
                "headline-md": ["Plus Jakarta Sans", ...defaultTheme.fontFamily.sans],
                "headline-lg": ["Plus Jakarta Sans", ...defaultTheme.fontFamily.sans]
            },
            colors: {
                "surface-container-lowest": "#ffffff",
                "on-primary-fixed": "#341100",
                "secondary": "#565e74",
                "primary-fixed-dim": "#ffb690",
                "surface-container-high": "#dce9ff",
                "inverse-surface": "#213145",
                "on-error-container": "#93000a",
                "tertiary-fixed": "#d8e2ff",
                "on-surface-variant": "#584237",
                "on-error": "#ffffff",
                "surface-container": "#e5eeff",
                "secondary-fixed": "#dae2fd",
                "background": "#f8f9ff",
                "tertiary": "#005ac2",
                "surface-container-highest": "#d3e4fe",
                "on-secondary-container": "#5c647a",
                "primary-container": "#f97316",
                "on-secondary-fixed-variant": "#3f465c",
                "inverse-primary": "#ffb690",
                "on-tertiary-fixed-variant": "#004395",
                "on-tertiary-container": "#00306e",
                "primary-fixed": "#ffdbca",
                "outline-variant": "#e0c0b1",
                "primary": "#9d4300",
                "error-container": "#ffdad6",
                "on-background": "#0b1c30",
                "on-surface": "#0b1c30",
                "on-tertiary-fixed": "#001a42",
                "on-secondary": "#ffffff",
                "surface-variant": "#d3e4fe",
                "secondary-fixed-dim": "#bec6e0",
                "surface-container-low": "#eff4ff",
                "inverse-on-surface": "#eaf1ff",
                "on-primary-fixed-variant": "#783200",
                "error": "#ba1a1a",
                "on-tertiary": "#ffffff",
                "on-primary": "#ffffff",
                "surface-dim": "#cbdbf5",
                "surface": "#f8f9ff",
                "on-secondary-fixed": "#131b2e",
                "surface-bright": "#f8f9ff",
                "tertiary-fixed-dim": "#adc6ff",
                "on-primary-container": "#582200",
                "outline": "#8c7164",
                "tertiary-container": "#6399ff",
                "surface-tint": "#9d4300",
                "secondary-container": "#dae2fd"
            },
            fontSize: {
                "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                "headline-lg-mobile": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                "display-lg-mobile": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                "display-lg": ["64px", {"lineHeight": "72px", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                "headline-md": ["30px", {"lineHeight": "38px", "fontWeight": "700"}],
                "headline-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.01em", "fontWeight": "700"}]
            },
            spacing: {
                "xl": "32px",
                "lg": "24px",
                "xxl": "64px",
                "xs": "4px",
                "gutter": "24px",
                "md": "16px",
                "base": "4px",
                "sm": "8px",
                "container-max": "1280px"
            }
        },
    },

    plugins: [forms, containerQueries],
};
