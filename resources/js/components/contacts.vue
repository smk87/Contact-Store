<template>
  <dir>
    <h1>Contacts</h1>
    <form action="#" @submit.prevent="edit?updateContact(contact.id):createContact()">
      <div class="form-group">
        <label for>Name</label>
        <input v-model="contact.name" type="text" name="name" class="form-control">
      </div>
      <div class="form-group">
        <label for>Email</label>
        <input v-model="contact.email" type="text" name="email" class="form-control">
      </div>
      <div class="form-group">
        <label for>Phone</label>
        <input v-model="contact.phone" type="text" name="phone" class="form-control">
      </div>
      <div class="form-group">
        <button v-show="!edit" type="submit" class="btn btn-primary">New Contact</button>
        <button v-show="edit" type="submit" class="btn btn-primary">Update Contact</button>
      </div>
    </form>
  </dir>
</template>

<script>
export default {
  data: function() {
    return {
      edit: false,
      list: [],
      contact: {
        id: "",
        name: "",
        phone: ""
      }
    };
  },
  mounted: function() {
    console.log("Contacts Component Loaded...");
    this.fetchContactList();
  },
  methods: {
    fetchContactList: function() {
      console.log("fetch");
      axios
        .get("api/contacts")
        .then(res => {
          console.log(res.data);
          this.list = res.data;
        })
        .catch(err => console.log(err));
    },
    createContact: function() {
      console.log("create");
      let self = this;
      let params = Object.assign({}, self.contact);
      axios
        .post("api/contact/store", params)
        .then(res => {
          self.contact.name = "";
          self.contact.email = "";
          self.contact.phone = "";
          self.edit = "";
          self.fetchContactList();
        })
        .catch(err => console.loge(err));
      return;
    },
    updateContact: function(id) {
      console.log("update" + id);
      return;
    }
  }
};
</script>

