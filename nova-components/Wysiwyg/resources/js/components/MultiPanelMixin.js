export default {
    computed: {
        panels() {
            return this.fields.reduce(function(panels, field){
                var panel = panels.find(panel=>panel.name==field.panel);
                if(panel && panel.fields)
                    panel.fields.push(field);
                else panels.push({name: field.panel, fields: [field]})
                return panels;
            },[]);
        },
    },
}