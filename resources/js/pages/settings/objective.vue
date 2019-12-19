<template>
    <card :title="$t('your_info')">
        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
            <alert-success :form="form" :message="$t('info_updated')"/>

            <!-- Objective -->
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right" for="objective">{{ $t('objective') }} <span class="text-danger">*</span></label>
                <div class="col-md-7">
                    <textarea v-model="form.objective" :class="{ 'is-invalid': form.errors.has('objective') }" class="form-control" rows="10" name="objective" id="objective" :placeholder="$t('Write your objective')"></textarea>
                    <has-error :form="form" field="objective"/>
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

    export default {
        scrollToTop: false,

        components: {
        },

        metaInfo() {
            return {title: this.$t('objective')}
        },

        data: () => ({
            form: new Form({
                objective: '',
            })
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
                const {data} = await this.form.patch('/api/settings/objective')

                this.$store.dispatch('auth/updateUser', {user: data})
            }
        }
    }
</script>

<style scoped>
    .col-form-label {
        text-transform: capitalize;
    }
</style>
