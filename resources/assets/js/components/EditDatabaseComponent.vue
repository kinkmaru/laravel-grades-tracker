<template>
    <div style="display:inline-block;">
        <button class="btn btn-info" v-on:click="showModal(modalID, formData.id)">Edit</button>

        <modal :name="createModalID(modalID, 'editData')" :draggable="true">
            <component :is="componentName"
                       :formText="formData"
                       v-on:editSuccess="editComplete(modalID, formData.id)"
            >
            </component>
        </modal>
    </div>
</template>

<script>
    import editClass from './EditClass.vue';
    import editAssignment from './EditAssignment.vue';

    export default {
        data:
            function() {
                return{
                    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            },
        props: {
            formData: {type: Object, default: {}},
            modalID: Number,
            actionPath: '',
            editData: {type: Array, default: []},
            componentName: ''
        },
        methods: {
            showModal (id, formID) {
                if(id === formID)
                    this.$modal.show('editData'+id.toString());
            },
            hideModal (id, formID) {
                if(id === formID)
                    this.$modal.hide('editData'+id.toString());
            },
            createModalID (id, string){
                return string + id;
            },
            editComplete (id, formID) {
                this.$emit('updateTable');
                this.hideModal(id, formID);
            }
        },
        components: {
            editClass,
            editAssignment
        }
    }
</script>