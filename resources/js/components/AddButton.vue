<template>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            +
        </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Добавить кнопку</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="cutaway-buttons-list">
                            <li v-for="element in contacts">
                                <a @click="addButton(element.id, $event)" :style="{color: element.color, backgroundColor: element.background_color}" target="_blank" href="#" class="contact-button">
                                    <div class="contact-logo">
                                        <img style="width:20px" class="contact-logo-img" :src="'/' + element.logo" alt="">
                                    </div>
                                    <div class="contact-text">
                                        <div class="contact-text-top">{{ element.title}}</div>
                                        <div class="contact-text-bottom">{{ element.title}}</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddButton",
        props: ['contacts', 'profile_id'],
        data() {
            return {

            }
        },
        methods: {
            addButton(contact_id, event){
                event.preventDefault();
                document.location.href = '/add-contact/' + this.profile_id + '/' + contact_id;
            },
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
