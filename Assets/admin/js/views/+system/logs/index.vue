<template>
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <table class="table table-striped data-table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Level</th>
                        <th>Content</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="log in logs" :title="log.text">
                        <td>{{ log.date }}</td>
                        <td :class="' text-capitalise text-'+log.level_class">
                            <span :class="'glyphicon glyphicon-'+ log.level_img + '-sign'" aria-hidden="true"></span>
                            &nbsp;
                            {{ log.level }}
                        </td>

                        <td>{{ log.text.substring(0, 30) }} ....</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script type="text/babel">
    import Vue from 'vue';
    import Component from 'vue-class-component'

    @Component
    export default class Logs extends Vue {
        logs = [];

        mounted() {
            this.$http.get('/api/logs')
                    .then(res => {
                        this.logs = res.data.data.logs;
                    })
        }

    }
</script>
