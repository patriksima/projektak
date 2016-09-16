<template>
    <dialog id="{{ id }}" class="mdl-dialog" v-show="show">
    	<h4 class="mdl-dialog__title">Request</h4>
    	<div class="mdl-dialog__content">
            <p>
                I need more time for task<br>{{ data.name }}.
            </p>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="number" name="estimate" v-model="data.estimate" step="0.01" required />
				<label class="mdl-textfield__label">Time</label>
		    </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" name="reason" v-model="data.reason" />
				<label class="mdl-textfield__label">Reason</label>
		    </div>
    	</div>
    	<div class="mdl-dialog__actions">
    		<button @click.stop="close()" type="button" class="mdl-button">Cancel</button>
    		<button @click.stop="request()" type="button" class="mdl-button">Request</button>
    	</div>
    </dialog>
</template>

<script>
export default {
    props: {
        id: {
            type: String,
            required: true
        },
        data:{
            type: Object
        }
    },
    data () {
        return {
            show: false
        }
    },
    watch: {
        show: function(n, o) {
            if (n) {
                document.querySelector('#'+this.id).showModal();
            } else {
                document.querySelector('#'+this.id).close();
            }
        }
    },
    methods: {
        open () {
          this.show = true
          this.$emit('open')
        },
        close () {
          this.show = false
          this.$emit('close')
        },
        request () {
          this.show = false
          this.$dispatch('request')
        }
    }
};
</script>
