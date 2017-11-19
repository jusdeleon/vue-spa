<template>
    <div class="container">
        <div class="columns">
            <div class="column">
                <div class="message" v-for="status in statuses">
                    <div class="message-header">
                        <p>
                            {{ status.user.name }} said...
                        </p>
                        <p>{{ status.created_at | ago }}</p>
                    </div>
                    <div class="message-body" v-text="status.body"></div>
                </div>
                <add-to-stream @added="addToStream"></add-to-stream>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import AddToStream from '../components/AddToStream';

    export default {
        components: {
            AddToStream
        },
        data() {
            return {
                statuses: []
            }
        },
        filters: {
            ago(date) {
                return moment(date).fromNow();
            }
        },
        methods: {
            addToStream(status) {
                this.statuses.unshift(status);
            }
        },
        created() {
            axios.get('/statuses')
                .then(({data}) => this.statuses = data);
        }
    }
</script>
