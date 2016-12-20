export default {
  methods: {
    load(resource) {
      this.$http
        .get(`api/${resource}`)
        .then(({ body }) => {
          this[resource] = body.data;
        })
    },

    destroy(resource, key) {
      this.$http.delete(`api/${resource}/${key}`);

      this[resource] = this[resource].filter(item => item.id !== key);
    },

    store(resource) {
      this.$http
        .post(`api/${resource}`, this.formData)
        .then(body => this[resource] = this.load(resource))
        .catch(({ body }) => this.error(body));

      this.formData = {};
    },

    edit(resource, object) {
      this.formData = this.editing = object;
    },

    update(resource) {
      this.$http.put(`api/${resource}/${this.editing.id}`, this.formData)
        .then(body => this[resource] = this.load(resource))
        .catch(({ body }) => this.error(body));

      this.editing = false;
      this.formData = {};
    },

    error(messages) {
      console.log('xD');
      $('.create-form input[name="name"]').parent().addClass('has-error');
    }
  }
}
