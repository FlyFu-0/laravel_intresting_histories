import './bootstrap';

import Alpine from 'alpinejs';
import TomSelect from "tom-select";

window.Alpine = Alpine;

Alpine.start();

window.initTagsInput = function(tags) {
    new TomSelect("#tags-input", {
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        persist: false,
        createOnBlur: true,
        create: false,
        maxOptions: 10,
        hidePlaceholder: true,
        options: tags,
        render: {
            option: function(item, escape) {
                return `
                    <div class="flex items-center p-2">
                        <span class="text-sm">${escape(item.name)}</span>
                    </div>
                `;
            },
            item: function(item, escape) {
                return `
                    <div class="ts-chip">
                        <span class="ts-chip-text">${escape(item.name)}</span>
                        <a class="ts-chip-remove" data-chip-id="ts-chip-remove-${escape(item.id)}">x</a>
                    </div>
                `;
            }
        },
        onItemAdd: function (val, item) {
            item.querySelector('.ts-chip-remove').addEventListener('click', (e) => {
                this.removeItem(item);
            });
        },
    });
}
