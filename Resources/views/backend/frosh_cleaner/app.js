Ext.define('Shopware.apps.FroshCleaner', {
    extend:'Enlight.app.SubApplication',
    name:'Shopware.apps.FroshCleaner',
    bulkLoad: true,
    loadPath:'{url action=load}',

    controllers:[
        'Main'
    ],
    models:[],
    stores:[],
    views:[
        'main.Window'
    ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});