<template>
  <div>
    <div class="container mx-auto">
      <div class="container flex justify-center mx-auto">
        <div class="flex flex-col">
          <div class="w-full">
            <div class="border-b border-gray-200 shadow">
              <h2 class="text-5xl font-normal leading-normal mt-0 mb-2 text-pink-800">
                List of Users
              </h2>
              <button @click="showCreateModal = true" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mb-8">Add User</button>
              <table>
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-2 text-xs text-gray-500">Name</th>
                    <th class="px-6 py-2 text-xs text-gray-500">Email</th>
                    <th class="px-6 py-2 text-xs text-gray-500">Address</th>
                    <th class="px-6 py-2 text-xs text-gray-500">
                      Phone Number
                    </th>
                    <th class="px-6 py-2 text-xs text-gray-500">FB username</th>
                    <th class="px-6 py-2 text-xs text-gray-500">Action</th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                  <tr
                    class="whitespace-nowrap"
                    v-for="user in users"
                    :key="user.id"
                  >
                    <td class="px-6 py-4">
                      <div class="text-sm text-gray-900">{{ user.name }}</div>
                    </td>
                    <td class="px-6 py-4">
                      <div class="text-sm text-gray-500">{{ user.email }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                      {{ !!user.profile ? user.profile.address : "" }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                      {{ !!user.profile ? user.profile.phone_number : "" }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                      {{ !!user.profile ? user.profile.fb_number : "" }}
                    </td>
                    <td class="px-6 py-4">
                      <a
                        href="#"
                        class="px-4 py-1 text-sm text-white bg-blue-400 rounded"
                        @click="editUser(user.id)"
                        >Edit</a
                      >
                       | 
                      <a
                        href="#"
                        class="px-4 py-1 text-sm text-white bg-red-400 rounded"
                        @click="deleteUser(user.id)"
                        >Delete</a
                      >
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                    <div class="flex items-center space-x-1">
                    <button 
                        :disabled="!pagination.prev_page_url" 
                        :class="[{disabled: !pagination.prev_page_url}]" 
                        @click="setPagePagination(page_pagination--)" 
                        class="px-4 py-2 font-bold text-gray-500 bg-gray-300 rounded-md hover:bg-blue-400 hover:text-white">Previous</button>
                    <button 
                        :disabled="!pagination.next_page_url" 
                        :class="[{disabled: !pagination.next_page_url}]" 
                        @click="setPagePagination(page_pagination++)" 
                        class="px-4 py-2 font-bold text-gray-500 bg-gray-300 rounded-md hover:bg-blue-400 hover:text-white">Next</button>
                </div>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <FormModal :show="showCreateModal" :title="modalTitle" @closeModal="closeModal">
        <template v-slot:body>
            <div v-if="errors !== null" class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                <p class="font-bold">Error!</p>
                <p v-for="(value, key, index) in errors" :key="index">{{ value }}</p>
            </div>
            
            <form  @submit.prevent="setUserData">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold" for="name">
                        Name
                    </label>
                    <input
                     v-model="fields.name"
                     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold" for="email">
                        Email
                    </label>
                    <input
                        v-model="fields.email"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" 
                        type="email"
                        placeholder="Email Address">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold" for="password">
                        Password
                    </label>
                    <input
                        v-model="fields.password"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" 
                        type="password"
                        placeholder="Password">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold" for="address">
                        Address
                    </label>
                    <input
                        v-model="fields.address"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="address" 
                        type="text"
                        placeholder="Address">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold" for="phone_number">
                        Phone Number
                    </label>
                    <input
                        v-model="fields.phone_number"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="phone_number" 
                        type="text"
                        placeholder="Phone Number">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold" for="fb_username">
                        FB Username
                    </label>
                    <input
                        v-model="fields.fb_username"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="fb_username" 
                        type="text"
                        placeholder="FB Username(Optional)">
                </div>
                <div class="mb-4">
                    <button type="submit" class="px-4 py-1 text-lg text-white bg-blue-400 rounded">
                        {{ formButtonText }}
                    </button>
                </div>
            </form>
        </template>
    </FormModal>

    <ButtonModal 
        :show="dialogModal.show"
        :title="dialogModal.title"
        buttonConfirmTitle='Delete'
        @closeDialogModal="closeDialogModal"
        @confirmDialogModal="deleteUserDetails"
    />
    
  </div>
</template>

<script>
    import FormModal from './Modals/FormModal.vue'
    import ButtonModal from './Modals/ButtonModal.vue'

    export default {
        components: {
            FormModal,
            ButtonModal
        },
        data() {
            return {
                users: [],
                user_id: null,
                page_pagination: 1,
                pagination: {},
                showCreateModal: false,
                modalTitle: 'Add New User',
                formButtonText: 'Create User',
                is_update: false,
                fields: {},
                errors: null,
                dialogModal: {
                    show: false,
                    title: 'Delete this User?',
                    description: 'Are you sure you want to delete this user?'
                }
            };
        },
        created() {
            this.getUsers();
        },
        methods: {
            async getUsers() {
                const resp = await this.$api.get("users", {}, {page: this.page_pagination});
                this.users = resp.data;
                this.makePagination(resp.meta, resp.links)
            },

            makePagination(meta, links) {
                this.pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                }
            },

            setPagePagination(page_active) {
                this.getUsers()
            },

            async deleteUserDetails() {
                await this.$api.delete('users/' + this.user_id);
                this.getUsers()
                this.closeDialogModal()
            },
            deleteUser(id) {
                this.dialogModal.show = true
                this.user_id = id
            },

            setUserData() {
                if(!this.is_update) {
                    this.createNewUser()
                } else {
                    this.updateUser()
                }
            },

            async createNewUser() {
                const resp = await this.$api.post('users', this.fields)
                if(resp.message) {
                    this.errors = resp.message
                } else {
                  this.getUsers();
                  this.closeModal()
                }
            },

            async editUser(id) {
                const resp = await this.$api.get(`users/${id}/edit`)
                const item = resp.data;

                this.fields = item
                this.fields.address = item.profile.address
                this.fields.phone_number = item.profile.phone_number
                this.fields.fb_username = item.profile.fb_username

                this.modalTitle = `Modify User: ${item.name}`
                this.formButtonText = "Update User"
                this.is_update = true
                this.showCreateModal = true
            },

            async updateUser() {
                const resp = await this.$api.put(`users/${this.fields.id}`, this.fields)
                if(resp.message) {
                    this.errors = resp.message
                } else {
                  this.getUsers()
                  this.closeModal()
                }
            },

            closeModal() {
                this.fields = {}
                this.errors = null
                this.is_update = false
                this.modalTitle = "Add New User"
                this.formButtonText= 'Create User'
                this.showCreateModal = false
            },

            closeDialogModal() {
                this.user_id = null
                this.dialogModal.show = false
            }
        },
    };
</script>