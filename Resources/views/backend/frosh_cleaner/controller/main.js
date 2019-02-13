Ext.define('Shopware.apps.FroshCleaner.controller.Main', {
    extend: 'Enlight.app.Controller',
    affectedRows: 0,

    init: function () {
        var me = this;

        Ext.Ajax.request({
            url: '{url action=processors}',
            success: function (response) {
                me.mainWindow = me.getView('main.Window').create({
                    processors: JSON.parse(response.responseText).data
                });
            }
        });

        me.control({
            'frosh-window': {
                clear: me.clear
            }
        })
    },

    clear: function (window) {
        var processors = [],
            progressBar = window.down('[xtype=progressbar]');

        progressBar.updateProgress(0);

        window.processors.forEach(item => {
            if (window.down('[name=' + item.id + ']').getValue()) {
                processors.push(item);
            }
        });
        progressBar.updateProgress(0);
        this.affectedRows = 0;
        this.callProcess(progressBar, processors, 0);
    },

    callProcess: function (progressBar, processors, index) {
        var me = this;
        progressBar.updateProgress((index + 1) / processors.length, processors[index].name);

        Ext.Ajax.request({
            url: '{url action=process}?process=' + processors[index].id,
            success: function (response) {
                this.affectedRows += parseInt(JSON.parse(response.responseText).affectedRows);

                if (typeof processors[index + 1] === 'undefined') {
                    Shopware.Notification.createGrowlMessage('', Ext.String.format('{s name=successTitle namespace=backend/frosh_cleaner/main}{/s}', me.affectedRows));
                    return;
                }

                me.callProcess(progressBar, processors, index + 1);
            }
        });
    }


});