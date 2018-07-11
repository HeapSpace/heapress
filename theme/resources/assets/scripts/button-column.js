(function() {
    tinymce.create('tinymce.plugins.hscolumn', {
        init: function(ed, url) {
            var data = {
                type: '2'
            }
            ed.addButton('hscolumn', {
                title: 'HS Column',
                image: url + '/columns.png',
                onclick: function() {
                    ed.windowManager.open({
                        title: 'Add columns',
                        width: 400,
                        height: 200,
                        buttons: [{
                            text: 'Insert',
                            id: 'section-button-insert',
                            class: 'insert',
                            onclick: function(e) {
                                var txt = '';
                                switch (data.type) {
                                  case '2':
                                    txt = '[hs-col-2]column1[/hs-col-2][hs-col-2-last]column2[/hs-col-2-last]';
                                    break;
                                  case '3':
                                    txt = '[hs-col-3]column1[/hs-col-3][hs-col-3]column2[/hs-col-3][hs-col-3-last]column3[/hs-col-3-last]';
                                    break;
                                  case '3-1':
                                    txt = '[hs-col-3-1]column1[/hs-col-3-1][hs-col-3-23]column2[/hs-col-3-23]';
                                    break;
                                }

                                ed.execCommand('mceInsertContent', false, txt);
                                ed.windowManager.close();
                            },
                        }, {
                            text: 'Cancel',
                            id: 'section-button-cancel',
                            onclick: 'close'
                        }],
                        data: data,
                        body: [{
                            name: 'type',
                            type: 'listbox',
                            label: 'Column configuration',
                            values: [{
                                value: '2',
                                text: '1/2 | 1/2'
                            }, {
                                value: '3',
                                text: '1/3 | 1/3 | 1/3'
                            }, {
                                value: '3-1',
                                text: '1/3 | 2/3'
                            }],
                            onselect: function() {
                                data.type = this.value();
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
                longname: "HS Column",
                author: 'igr',
                authorurl: 'https://github.com/igr',
                infourl: '',
                version: "1.0"
            };
        }
    });
    tinymce.PluginManager.add('hscolumn', tinymce.plugins.hscolumn);
})();
