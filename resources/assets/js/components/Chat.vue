<template>
    <div class="chat mdl-card mdl-shadow--2dp">
        <div class="chat-title mdl-card__title" @click="toggleWindow()">
            <h2 class="mdl-card__title-text">Chat</h2>
        </div>

    <div class="chat-messages mdl-card__supporting-text mdl-card--expand" v-show="open">
            <div class="chat-message" v-for="sentMessage in messages">

                <p
                    class="mdl-chip chat-message"
                    v-if="sentMessage.sender !== undefined && user.id != sentMessage.sender.id"
                >
                    <span class="chat-name mdl-chip__contact mdl-color--teal mdl-color-text--white">
                        {{ sentMessage.sender.name }}
                    </span>

                    <span class="mdl-chip__text">{{ sentMessage.body }}</span>
                </p>

                <p v-else class="mdl-chip chat-message pull-right">
                    <span class="mdl-chip__text">{{ sentMessage.body }}</span>
                </p>
            </div>
        </div>

        <div class="mdl-card__actions mdl-card--border" v-show="open">
            <form action="#" @submit.prevent="sendMessage()">
                <div class="mdl-textfield mdl-js-textfield">
                    <input
                        class="mdl-textfield__input"
                        placeholder="Type your message"
                        type="text"
                        v-model="message"
                    >
                    <label class="mdl-textfield__label" for="sample1">Type your message</label>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import UserActions from './../mixins/UserActions';

export default {
    props: ['channel'],

    mixins: [UserActions],

    data() {
        return {
            message: '',
            messages: [],
            user: {},
            open: false
        };
    },

    mounted() {
        this.listen();

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
                body: this.message
            })

            this.messages.push({ body: this.message });
            this.message = '';

            this.scrollDown();
        },

        /**
         * Ajax call to load all messages.
         */
        loadMessages() {
            this.$http.get('/api/chat/' + this.channel)
                .then(({ body }) => this.messages = body);
        },

        /**
         * Listening on echo channels.
         */
        listen() {
            Echo.channel(this.channel)
                .listen('Chat\\MessageSent', (body) => {
                    // Now we have to parse the sender back to the
                    // message. This is worth opening an issue on Laravel
                    // itself.
                    body.message.sender = body.sender;
                    this.messages.push(body.message);

                    this.scrollDown();
                });
        },

        /**
         * Helper to keep the chat window scrolled down.
         */
        scrollDown() {
            var chatWindow = document.querySelector('.chat-messages');
            chatWindow.scrollTop = chatWindow.scrollHeight;
        },

        /**
         * Toggles the chat window.
         */
        toggleWindow() {
            this.open = ! this.open;
            this.scrollDown();
        }
    }
};
</script>
