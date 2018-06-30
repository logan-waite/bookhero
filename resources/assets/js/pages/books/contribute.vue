<template>
  <div id='contribute'>
    <form v-if="! submitted">
      <div class="form-row">
        <div class="form-group col">
          <input class="form-control" type="text" placeholder="Title" v-model="title">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col">
          <input class="form-control" type="text" placeholder="Author" v-model="author">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col">
          <input class="form-control" type="text" placeholder="Summary" v-model="summary">
        </div>
      </div>
      <div class="form-row" v-for="ba in book_attributes">
        <p>Please select one or more attributes and give the book a rating between 1 and 5.</p>
        <div class="form-group col-8">
          <select class="form-control custom-select" v-model="ba.attr_id">
            <option disabled value="">Select an Attribute</option>
            <option v-for="attr in attributes"
                    :value="attr.id"
                    :disabled="book_attributes.some( a => a.attr_id === attr.id )">{{ attr.name }}</option>
          </select>
        </div>
        <div class="form-group col-4">
          <input class="form-control" type="number" v-model.number="ba.value">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <button class="add-attribute btn btn-primary" @click.prevent="addAttribute()">
            <i class="fal fa-plus"></i> Add Attribute
          </button>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <button class="submit-form btn btn-success" @click="submitBook()"> Submit Form </button>
        </div>
      </div>
    </form>
    <div class="alert alert-success" v-else>
      <h4 class="alert-heading">Thanks for your contribution!</h4>
      <p>You'll be able to find the book you added on the "Discover" page.</p>
      <button class="btn btn-outline-success" @click="resetSubmitForm()">Do It Again!</button>
    </div>
  </div>
</template>

<script>
import { EventBus } from '../../event-bus.js';
export default {
  data: function() {
    return {
      submitted: false,
      title: '',
      author: '',
      summary: '',
      book_attributes: [
        {
          attr_id: '',
          value: 0,
        }
      ],
    }
  },
  computed: {
    attributes: function() {
      return this.$store.state.attributes.attributes;
    },
  },
  methods: {
    addAttribute: function() {
      this.book_attributes.push({ attr_id: '', value: 0 });
    },
    submitBook: function() {
      let self = this;
      let info = {
        title: this.title,
        author: this.author,
        summary: this.summary,
        attributes: this.book_attributes
      };

      this.$store.dispatch( 'submitNewBook', info )
      .then( function( response ) {
        // EventBus.$emit( 'loadCoreData' );
        self.submitted = true;
        self.$store.dispatch( 'getAllBooks' );
      });
    },
    resetSubmitForm() {
      this.title = '';
      this.author = '';
      this.summary = '';
      this.book_attributes = [{attr_id: '', value: 0}];
      this.submitted = false;
    }
  }
}
</script>