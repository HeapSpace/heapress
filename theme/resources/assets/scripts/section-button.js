(function() {
    tinymce.create('tinymce.plugins.hssection', {
        init: function(ed, url) {
            var data = {
                color: 'red',
                page: '',
            }
            ed.addButton('hssection', {
                title: 'HS section',
                image: url + '/section.png',
                onclick: function() {
                    ed.windowManager.open({
                        title: 'Section definition',
                        //                url: url + '/section.html',
                        width: 400,
                        height: 200,
                        buttons: [{
                            text: 'Insert',
                            id: 'section-button-insert',
                            class: 'insert',
                            onclick: function(e) {
                                var color = data.color;
                                var page = data.page;
                                var attr = '';
                                if (color != null && color != '') {
                                  attr = attr + " color=" + color + '"';
                                }
                                if (page != null && page != '') {
                                  attr = attr + " page=" + page + '"';
                                }
                                ed.execCommand('mceInsertContent', false, '[hs-section' + attr + '] CONTENT (if page is not used) [/hs-section]');
                                ed.windowManager.close();
                            },
                        }, {
                            text: 'Cancel',
                            id: 'section-button-cancel',
                            onclick: 'close'
                        }],
                        data: data,
                        body: [{
                            name: 'page',
                            type: 'textbox',
                            label: 'Page:',
                            value: data.page,
                            onchange: function() {
                                data.page = this.value();
                            }
                        }, {
                            name: 'color',
                            type: 'listbox',
                            label: 'Color:',
                            values: [{
                                value: 'red',
                                text: 'Red'
                            }, {
                                value: 'blue',
                                text: 'Blue'
                            }, {
                                value: 'beige',
                                text: 'Beige'
                            }, {
                                value: 'black',
                                text: 'Black'
                            }],
                            onchange: function() {
                                data.color = this.value();
                            }
                        }],
                    });
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
        getInfo: function() {
            return {
                longname: "HS Section",
                author: 'igr',
                authorurl: 'https://github.com/igr',
                infourl: '',
                version: "1.0"
            };
        }
    });
    tinymce.PluginManager.add('hssection', tinymce.plugins.hssection);
})();
