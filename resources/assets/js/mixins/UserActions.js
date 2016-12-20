export default {
    methods: {
        loadLoggedUser() {
            return this.$http
                .get('/api/user')
                .then(({ body }) => this.user = body);
        }
    }
}
