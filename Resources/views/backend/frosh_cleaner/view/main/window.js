Ext.define('Shopware.apps.FroshCleaner.view.main.Window', {
    extend: 'Enlight.app.Window',
    title: '{s name=title namespace=backend/frosh_cleaner/main}{/s}',
    autoShow: true,
    border: false,
    height: 450,
    width: 600,
    stateful: true,
    layout: {
        type: 'vbox',
        pack: 'start',
        align: 'stretch'
    },
    alias: 'widget.frosh-window',

    initComponent: function() {
        this.dockedItems = [{
            xtype: 'toolbar',
            items: this.createButtons(),
            ui: 'shopware-ui',
            dock: 'bottom'
        }];

        this.items = this.getItems();
        this.callParent(arguments);
    },

    getItems: function() {
        var items = {
                0: [],
                1: [],
            },
            i = 1,
            me = this;

        me.processors.forEach(item => {
            var index = (i % 2 === 0) ? 1 : 0;
            items[index].push({
                name: item.id,
                xtype: 'checkbox',
                fieldLabel: item.name,
                inputValue: true,
                uncheckedValue: false,
                labelWidth: 155,
                checked: true,
            });
            i++;
        });

        return [
            {
                title: '{s name=fieldSetLabel namespace=backend/frosh_cleaner/main}{/s}',
                xtype: 'fieldset',
                margin: 20,
                items: [
                    {
                        flex: 2,
                        xtype: 'container',
                        layout: {
                            type: 'hbox',
                            pack: 'start',
                            align: 'stretch'
                        },
                        items: [
                            me.createSettingsLeftItems(items[0]),
                            me.createSettingsRightItems(items[1])
                        ]
                    },
                ]
            },
            Ext.create('Ext.ProgressBar', {
                animate: true,
                text: '...',
                margin: '20',
                style: 'border-width: 1px !important;',
                cls: 'left-align'
            })
        ];
    },

    createSettingsLeftItems: function(items) {
        return {
            xtype: 'container',
            items: items,
            width: '48%',
            style: {
                'margin-right': '45px'
            }
        };
    },

    createSettingsRightItems: function(items) {
        return {
            xtype: 'container',
            items: items,
            width: '48%',
        };
    },

    createButtons: function() {
        return [
            '->',
            this.createStartButton()
        ];
    },

    createStartButton: function() {
        var me = this;

        return Ext.create('Ext.button.Button', {
            text: 'Löschen',
            cls: 'primary',
            action: 'start',
            handler: function() {
                me.fireEvent('clear', me);
            }
        });
    }
});