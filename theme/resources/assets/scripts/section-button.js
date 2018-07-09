(function() {
   tinymce.create('tinymce.plugins.hssection', {
      init : function(ed, url) {
         ed.addButton('hssection', {
            title : 'HS section',
            image : url + '/section.png',
            onclick : function() {
               var color = prompt("Section color", "");
               if (color != null && color != '')
                  ed.execCommand('mceInsertContent', false, '[hs-section color="' + color + '"] SECTION CONTENT [/hs-section]');
               else
                  ed.execCommand('mceInsertContent', false, '[hs-section] SECTION CONTENT [/hs-section]');
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "HS Section",
            author : 'igr',
            authorurl : 'https://github.com/igr',
            infourl : '',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('hssection', tinymce.plugins.hssection);
})();