<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th v-for="columns in columnData" >
                        {{columns}}
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr :style="getBackground(rowData, colorCompare)" v-for="rowData in tableData">

                    <td v-for="value, key in rowData" v-if="columnRows(value, key) != null">
                        {{value}}
                    </td>
                    <td>
                        <ConfirmDelete :deleteURI="setDeleteURI(rowData.id)"
                                       :deleteName="rowData.name"
                                       :modalID="rowData.id"
                                       v-on:updateTable="$emit('updateTable')">
                        </ConfirmDelete>

                        <EditDatabaseComponent :formData="rowData"
                                               :modalID="rowData.id"
                                               :actionPath="editPath + rowData.id"
                                               :editData="databaseEdits"
                                               :componentName="componentName"
                                               v-on:updateTable="$emit('updateTable')">
                        </EditDatabaseComponent>
                        <div style="display: inline-block;" v-if="routerPath != null">
                            <router-link class="btn btn-success" :to="{ name: routerPath, params: { id: rowData.id}}">Details</router-link>
                        </div>
                    </td>
                </tr>

            </tbody>

        </table>
    </div>
</template>

<script>
    import EditDatabaseComponent from './EditDatabaseComponent.vue';
    import ConfirmDelete from './DeleteConfirm.vue';

    export default{
        data:
            function() {
                return{
                    columnHeaders: [],
                    actionPath: this.editPath,
                    rowCount: 0,
                }
            },
        props: {
            colorCompare: {type: Array, default: null},
            columnData: {type: Array, default: []},
            tableData: {},
            routerPath: '',
            editPath: '',
            databaseEdits: '',
            componentName: ''
        },
        created: function(){
            this.lowercaseColumns();
        },
        methods: {
            lowercaseColumns(){
                let result = [];
                let col = this.columnData;
                col.forEach(function(e){
                    result.push(e.toLowerCase());
                });
                this.columnHeaders = result;
            },
            columnRows(value, key){
                return this.columnHeaders.includes(key) ? value : null;
            },
            getBackground(data, compare){
                if(compare != null)
                {
                    let x = data[compare[0]] - data[compare[1]];
                    if(x <= 0)
                    {
                        return 'background: #CBECEC';
                        // blue
                    }
                    else if(10 > x > 0)
                    {
                        return 'background: #FFF99C';
                        // yellow
                    }
                    else
                    {
                        return 'background: #FFCFD2';
                        // red
                    }
                }
            },
            setDeleteURI(id){
                return '/api/classes/details/assignments/' + id;
            }
        },
        components: {
            EditDatabaseComponent,
            ConfirmDelete
        }
    }
</script>
