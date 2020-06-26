/*

Tailwind - The Utility-First CSS Framework

A project by Adam Wathan (@adamwathan), Jonathan Reinink (@reinink),
David Hemphill (@davidhemphill) and Steve Schoger (@steveschoger).

Welcome to the Tailwind config file. This is where you can customize
Tailwind specifically for your project. Don't be intimidated by the
length of this file. It's really just a big JavaScript object and
we've done our very best to explain each section.

View the full documentation at https://tailwindcss.com.
*/

var config = require('tailwindcss/defaultConfig')()
const tailwindColorPalette = require('@ky-is/tailwind-color-palette')

// fonts
config.fonts.sans = ['Roboto', ...config.fonts.sans]

// colors
const primaryColors = tailwindColorPalette('#00947D', { name: 'primary', greyscale: false })
const secondaryColors = tailwindColorPalette('#F9A01D', { name: 'secondary' })
const redColors =  tailwindColorPalette('#E3342F', { name: 'red' })
const greenColors =  tailwindColorPalette('#38C172', { name: 'green' })
const blueColors =  tailwindColorPalette('#3490DC', { name: 'blue' })
const yellowColors =  tailwindColorPalette('#FFED4A', { name: 'yellow' })
const greys = tailwindColorPalette('#CED1D9', { name: 'grey', greyscale: true })
greys['black'] = '#000000'
greys['grey-lightest'] = '#FAFBFF'
greys['grey-lighter'] = '#EEF1F5'
greys['grey-dark'] = '#707070'
greys['grey-darker'] = '#828899'
const colors = Object.assign(secondaryColors, primaryColors, greys, redColors, greenColors, blueColors, yellowColors)
config.colors = colors
config.textColors = colors
config.backgroundColors = colors
config.borderColors = Object.assign({ default: colors['grey-light'] }, colors)

// line height
config.leading.none = 1.15

// border widths
config.borderWidths = Object.assign(config.borderWidths, {
    '3': '3px',
    '5': '5px',
    '6': '6px',
    '7': '7px',
})

// shadows
config.shadows = {
    default: '0 3px 3px 0 rgba(0,0,0,0.10)',
    'md': '0 4px 8px 0 rgba(0,0,0,0.10)',
    'lg': '0 0 30px 0 rgba(0,0,0,0.10)',
    'inner': 'inset 0 2px 4px 0 rgba(0,0,0,0.06)',
    'outline': '0 0 0 3px rgba(52,144,220,0.5)',
    'none': 'none',
}

// shadow lookup  -  Allow @apply-ing classes that aren't defined but would be generated (#516)
//config.experiments = { shadowLookup: true };

// text sizes
config.textSizes['2xs'] = '0.625rem'

// gradients
/*
 * generates the following utilities
 * .bg-gradient-[direction-name]-[gradient-name] {
 *      background-image: linear-gradient([direction-value], [gradient-color-1], [gradient-color-2], [...])
 * }
 */

config.plugins.push(
    require('tailwindcss-gradients')({
        variants: ['responsive'],
        /*
        directions: {
            't': 'to top',
            'tr': 'to top right',
            'r': 'to right',
            'br': 'to bottom right',
            'b': 'to bottom',
            'bl': 'to bottom left',
            'l': 'to left',
            'tl': 'to top left',
        },
        */
        gradients: {
            'lighter-light': ['rgba(256,256,256,0.3)', 'rgba(256,256,256,0.1)'],
            'darker-dark': ['rgba(0,0,0,0.35)', 'rgba(0,0,0,0.06)'],
            'dark-light': ['rgba(0,0,0,0.70)', 'rgba(0,0,0,0)'],
        },
    }),
);

// alpha bg colors
config.plugins.push(
    require('tailwindcss-alpha')({
        modules: {
            backgroundColors: true
        },
        alpha: {
            '30': 0.3,
            '50': 0.5,
            '70': 0.7
        }
    })
);

config.modules.visibility = ['responsive', 'group-hover'];
config.modules.height = ['group-hover'];
config.modules.maxHeight = ['group-hover'];
config.modules.textColors = ['hover', 'group-hover'];

module.exports = config
