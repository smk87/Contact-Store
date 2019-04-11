<template>
  <div>
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
    <h1>Contacts</h1>
    <ul class="list-group">
      <li class="list-group-item" v-for="contact in list">
        <strong>{{contact.name}}</strong>
        {{contact.email}} {{contact.phone}}
        <button
          @click="showContact(contact.id)"
          class="btn btn-info btn-lg"
        >Edit</button>
        <button @click="deleteContact(contact.id)" class="btn btn-danger btn-lg">Delete</button>
      </li>
    </ul>
  </div>
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

    showContact: function(id) {
      let self = this;
      axios.get("api/contact/" + id).then(res => {
        self.contact.id = res.data.id;
        self.contact.name = res.data.name;
        self.contact.email = res.data.email;
        self.contact.phone = res.data.phone;
      });
      self.edit = true;
    },

    updateContact: function(id) {
      let self = this;
      let params = Object.assign({}, self.contact);
      axios
        .patch("api/contact/" + id, params)
        .then(res => {
          self.contact.name = "";
          self.contact.email = "";
          self.contact.phone = "";
          self.edit = false;
          self.fetchContactList();
        })
        .catch(err => console.loge(err));
      return;
    },
    deleteContact: function(id) {
      axios.delete("api/contact/" + id).then(res => {
        this.fetchContactList();
      });
    }
  }
};
</script>

