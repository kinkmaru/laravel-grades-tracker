<template>
    <div style="display: inline-block">
        <button v-on:click="showModal">+Add Section</button>

        <modal name="createSection" :draggable="true">
            <h2>Add a Section</h2>
            <form v-on:submit.prevent="submitSection" method="post">
                <label for="sectionName">Name: </label>
                <input type="text" id="sectionName" name="sectionName" v-model="sectionName">
                <label for="sectionWeight">Section Weight: </label>

                 <input type="text" name="sectionWeight" v-model="sectionWeight"><br><br>
                <div style="color: red" v-for="errors in displayErrors">
                    {{errors}}<br>
                </div><br>
                <input type="submit" value="Add Section">
                <input type="reset" value="Clear" v-on:click="clearErrors">
            </form>
            <br>

            <button v-on:click="closeModal">Cancel</button>
        </modal>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                displayErrors: [],
                sectionName: '',
                sectionWeight: '',
                insertSectionAPI: '/api/classes/details/' + this.sectionID,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        props:{
            sectionID: ''
        },
        methods: {
            submitSection () {
                let uri = this.insertSectionAPI;
                this.axios.post(uri, {
                    'sectionName': this.sectionName,
                    'sectionWeight': this.sectionWeight,
                    headers: {
                        'csrf': this.csrf
                    }
                }).then((response) => {
                    if(response.data === "OK") {
                        this.$emit('updateTable');
                        this.hideModal();
                    }
                    else {
                        this.listErrors(response.data);
                    }
                });
            },
            listErrors(errors){
                this.displayErrors = [];
                let count = 0;
                for (let error in errors)
                {
                    this.displayErrors[count] = errors[error];
                    count++;
                }
            },
            showModal () {
                this.$modal.show('createSection');
            },
            hideModal () {
                this.$modal.hide('createSection');
            },
            closeModal () {
                this.clearErrors();
                this.hideModal();
            },
            clearErrors() {
                this.displayErrors = [];
            },
        }
    }
</script>