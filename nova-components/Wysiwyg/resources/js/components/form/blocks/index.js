const requireModule = require.context(".", false, /\.vue$/); //extract vue files inside modules folder
const modules = {};

requireModule.keys().forEach(fileName => {
    const module = requireModule(fileName);
    const moduleName = _.upperFirst(_.camelCase(fileName.replace(/(\.\/|\.vue)/g, "")));
    modules[moduleName] = module.default || module;
});
//console.log(modules)
//export default modules;

export default {
    'Text': modules.Text,
    'Image': modules.Image,
    'Gallery': modules.Gallery,
    'Carousel': modules.Carousel,
    'Cover': modules.Cover,
    'Tabs': modules.Tabs,
    'Timeline': modules.Timeline,
    'Columns': modules.Columns,
    'Section': modules.Section,
    'Html': modules.Html,
    'Custom': modules.Custom,
    'Form': modules.Form,
    'Accordion': modules.Accordion,
    'Cards': modules.Cards,
    'Card': modules.Card,
}
