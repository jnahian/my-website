<template>
    <card :title="$t('your_info')">
        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
            <alert-success :form="form" :message="$t('info_updated')"/>

            <!-- Name -->
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right" for="name">{{ $t('name') }} <span class="text-danger">*</span></label>
                <div class="col-md-7">
                    <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name" id="name">
                    <has-error :form="form" field="name"/>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right" for="email">{{ $t('email') }} <span class="text-danger">*</span></label>
                <div class="col-md-7">
                    <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" id="email">
                    <has-error :form="form" field="email"/>
                </div>
            </div>

            <!-- Designation -->
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right" for="designation">{{ $t('Designation') }} </label>
                <div class="col-md-7">
                    <input v-model="form.designation" :class="{ 'is-invalid': form.errors.has('designation') }" class="form-control" type="text" name="designation"
                           placeholder="Enter Designation" id="designation">
                    <has-error :form="form" field="designation"/>
                </div>
            </div>

            <!-- Father Name -->
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right" id="father_name">{{ $t('Father Name') }} </label>
                <div class="col-md-7">
                    <input v-model="form.father_name" :class="{ 'is-invalid': form.errors.has('father_name') }" class="form-control" type="text" name="father_name"
                           placeholder="Enter Father Name" id="father_name">
                    <has-error :form="form" field="father_name"/>
                </div>
            </div>

            <!-- Mother Name -->
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right" for="mother_name">{{ $t('Mother Name') }} </label>
                <div class="col-md-7">
                    <input v-model="form.mother_name" :class="{ 'is-invalid': form.errors.has('mother_name') }" class="form-control" type="text" name="mother_name"
                           placeholder="Enter Mother Name" id="mother_name">
                    <has-error :form="form" field="mother_name"/>
                </div>
            </div>

            <!-- Mobile No. -->
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right" for="mobile">{{ $t('Mobile No.') }} </label>
                <div class="col-md-7">
                    <input v-model="form.mobile" :class="{ 'is-invalid': form.errors.has('mobile') }" class="form-control" type="text" name="mobile"
                           placeholder="Enter Mobile No." id="mobile">
                    <has-error :form="form" field="mobile"/>
                </div>
            </div>

            <!-- Date of Birth -->
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right" for="dob">{{ $t('Date of Birth') }} </label>
                <div class="col-md-7">
                    <date-picker v-model="form.dob" id="dob" :config="dateOptions" :class="{ 'is-invalid': form.errors.has('dob') }" class="form-control" placeholder="yyyy-mm-dd"></date-picker>
                    <has-error :form="form" field="dob"/>
                </div>
            </div>

            <!-- Gender -->
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right" for="gender-m">{{ $t('Gender') }} </label>
                <div class="col-md-7">
                    <div class="radio">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" v-model="form.gender" type="radio" :class="{ 'is-invalid': form.errors.has('gender') }" name="gender" id="gender-m" value="M">
                            <label class="form-check-label" for="gender-m">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" v-model="form.gender" type="radio" :class="{ 'is-invalid': form.errors.has('gender') }" name="gender" id="gender-f" value="F">
                            <label class="form-check-label" for="gender-f">Female</label>
                        </div>
                    </div>
                    <has-error :form="form" field="gender"/>
                </div>
            </div>

            <!-- Photo -->
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">{{ $t('Photo') }} </label>
                <div class="col-md-7">
                    <div v-if="!form.photo">
                        <input type="file" :class="{ 'is-invalid': form.errors.has('photo') }" @change="onFileChange" class="btn btn-outline-primary">
                    </div>
                    <div v-else>
                        <img :src="form.photo" class="img-thumbnail" width="100px" />
                        <br>
                        <button type="button" class="btn btn-danger btn-sm" @click="removeImage">Remove</button>
                    </div>
                    <has-error :form="form" field="photo"/>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group row">
                <div class="col-md-9 ml-md-auto">
                    <v-button :loading="form.busy" type="success">
                        {{ $t('update') }}
                    </v-button>
                </div>
            </div>
        </form>
    </card>
</template>

<script>
    import Form from 'vform'
    import {mapGetters} from 'vuex'
    import datePicker from 'vue-bootstrap-datetimepicker'
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css'

    export default {
        scrollToTop: false,

        components: {
            datePicker
        },

        metaInfo() {
            return {title: this.$t('settings')}
        },

        data: () => ({
            form: new Form({
                name: '',
                email: '',
                designation: '',
                father_name: '',
                mother_name: '',
                mobile: '',
                photo: '',
                cv: '',
                dob: new Date(),
                gender: '',
            }),
            dateOptions: {
                format: 'YYYY-MM-DD',
                useCurrent: false,
            }
        }),

        computed: mapGetters({
            user: 'auth/user'
        }),

        created() {
            // Fill the form with user data.
            this.form.keys().forEach(key => {
                this.form[key] = this.user[key]
            })
        },

        methods: {
            async update() {
                const {data} = await this.form.patch('/api/settings/profile')

                this.$store.dispatch('auth/updateUser', {user: data})
            },
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                    vm.form.photo = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                this.form.photo = '';
            }
        }
    }
</script>

<style scoped>
    .col-form-label {
        text-transform: capitalize;
    }

    .form-check-inline .form-check-input {
        margin-right: 10px;
    }

    .radio {
        line-height: 38px;
    }
</style>
