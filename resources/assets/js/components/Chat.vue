<template>
    <div style="width: 80%">
        <div v-for="sentMessage in messages" class="chat-message mdl-card mdl-shadow--2dp">
            <div class="chat-message-title mdl-card__title mdl-card--border">

                <h2 class="mdl-card__title-text">
                    {{ sentMessage.sender.name }}
                    <small>{{ parseDate(sentMessage.created_at) }}</small>
                </h2>
            </div>

            <div class="mdl-card__supporting-text" v-html="sentMessage.body"></div>
        </div>

        <div class="chat-message mdl-card mdl-shadow--2dp">
            <div class="chat-message-title mdl-card__title">
                <h2 class="mdl-card__title-text">Add New Message</h2>
            </div>

            <div class="mdl-card__actions">
                <form action="#" @submit.prevent="sendMessage()">
                    <div class="mdl-textfield mdl-js-textfield" style="width: 100%">
                        <textarea
                            class="mdl-textfield__input"
                            id="message"
                            rows= "3"
                            style="width: 100%"
                            type="text"
                            v-model="message"
                        ></textarea>

                        <label class="mdl-textfield__label" for="message">Type in your message</label>
                    </div>

                    <button
                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                    >
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
    h2 {
        display: flex;
        align-items: baseline;
    }

    h2 small {
        margin-left: 20px;
    }
</style>

<script>
import UserActions from './../mixins/UserActions';
import dateFormat from 'dateformat';

export default {
    props: ['channel'],

    mixins: [UserActions],

    data() {
        return {
            message: '',
            messages: [],
            user: {},
        };
    },

    mounted() {
        this.loadLoggedUser();

        this.loadMessages();
    },

    methods: {
        /**
         * Ajax call to send a message.
         */
        sendMessage() {
            this.$http.post('/api/chat', {
                channel: this.channel,
                body: this.message,
            }).then(({ body }) => this.messages.push(body));

            this.message = '';
        },

        /**
         * Ajax call to load all messages.
         */
        loadMessages() {
            this.$http.get('/api/chat/' + this.channel)
                .then(({ body }) => this.messages = body);
        },

        /**
         * Method that parses given date
         */
        parseDate(date) {
            return dateFormat(
                Date.parse(date), 'mmmm dS, H:MM'
            );
        }
    }
};
</script>
