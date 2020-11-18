<template>
  <div class="page-content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card m-b-20">
            <div class="card-header">
              <h3 class="card-title">User List</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="newModal"
                >
                  <i class="fa fa-plus-square"></i>
                  Add new
                </button>
              </div>
            </div>
            <div class="card-body" v-if="$gate.isAdmin()">
              <table
                id="datatable"
                class="table table-bordered dt-responsive nowrap"
                cellspacing="0"
                width="100%"
              >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Email</th>
                    <!-- <th>Email Verified?</th> -->
                    <th>Created</th>
                    <!-- <th>Photo</th> -->
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody v-for="user in data.data" :key="user.id">
                  <tr>
                    <td>{{ user.id }}</td>
                    <td class="text-capitalize">{{ user.type }}</td>
                    <td class="text-capitalize">{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td :inner-html.prop="user.created_at | myDate"></td>
                    <td>
                      <a href="#" @click="editModal(user)">
                        <i class="fa fa-edit blue"></i>
                      </a>
                      /
                      <a href="#" @click="deleteUser(user.id)">
                        <i class="fa fa-trash red"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->

      <!-- Modal -->
      <div
        class="modal fade"
        id="addNew"
        tabindex="-1"
        role="dialog"
        aria-labelledby="addNew"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" v-show="!editmode">Create New User</h5>
              <h5 class="modal-title" v-show="editmode">Update User's Info</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- <form @submit.prevent="createUser"> -->

            <form @submit.prevent="editmode ? updateUser() : createUser()">
              <div class="modal-body">
                <div class="form-group">
                  <label>Name</label>
                  <input
                    v-model="form.name"
                    type="text"
                    name="name"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                  />
                  <has-error :form="form" field="name"></has-error>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input
                    v-model="form.email"
                    type="text"
                    name="email"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('email') }"
                  />
                  <has-error :form="form" field="email"></has-error>
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input
                    v-model="form.password"
                    type="password"
                    name="password"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('password') }"
                    autocomplete="false"
                  />
                  <has-error :form="form" field="password"></has-error>
                </div>

                <div class="form-group">
                  <label>User Role</label>
                  <select
                    name="type"
                    v-model="form.type"
                    id="type"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('type') }"
                  >
                    <option value="">Select User Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">Standard User</option>
                  </select>
                  <has-error :form="form" field="type"></has-error>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Close
                </button>
                <button v-show="editmode" type="submit" class="btn btn-success">
                  Update
                </button>
                <button
                  v-show="!editmode"
                  type="submit"
                  class="btn btn-primary"
                >
                  Create
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- container-fluid -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: {},
      url: "http://localhost:3000/api/user",

      columns: [
        {
          label: "ID",
          name: "id",
          orderable: true,
        },
        {
          label: "Name",
          name: "name",
          orderable: true,
        },

        {
          label: "Email",
          name: "email",
          orderable: true,
        },

        {
          label: "Type",
          name: "type",
          orderable: true,
        },
      ],
      editmode: false,
      users: {},
      form: new Form({
        id: "",
        type: "",
        name: "",
        email: "",
        password: "",
        email_verified_at: "",
      }),
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("api/user?page=" + page)
        .then(({ data }) => (this.users = data.data));

      this.$Progress.finish();
    },
    updateUser() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("api/user/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.loadUsers();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(user) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(user);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    deleteUser(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete("api/user/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              // Fire.$emit('AfterCreate');
              this.loadUsers();
            })
            .catch((data) => {
              Swal.fire("Failed!", data.message, "warning");
            });
        }
      });
    },
    loadUsers() {
      this.$Progress.start();

      if (this.$gate.isAdmin()) {
        axios.get("api/user").then(({ data }) => (this.users = data.data));
      }

      this.$Progress.finish();
    },

    createUser() {
      this.form
        .post("api/user")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.loadUsers();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Some error occured! Please try again",
          });
        });
    },

    loadUsers() {
      this.$Progress.start();

      if (this.$gate.isAdmin()) {
        axios.get("api/user").then(({ data }) => (this.data = data.data));
      }

      this.$Progress.finish();
    },
  },
  mounted() {
    console.log("User Component mounted.");
    this.loadUsers();
  },
  created() {
    this.$Progress.start();

    this.$Progress.finish();
  },
};
</script>
