<template>
    <div>
        <draggable
            class="list-group"
            tag="ul"
            v-model="list"
            v-bind="dragOptions"
            @start="drag = true"
            @end="drag = false"
        >
            <transition-group type="transition" :name="!drag ? 'flip-list' : null">
                <li
                    class="list-group-item"
                    v-for="element in list"
                    v-on:dragend="sendOrders"
                    :key="element.order"

                >
                    <i
                        :class="
                        element.fixed ? 'fa fa-anchor' : 'glyphicon glyphicon-pushpin'"
                        @click="element.fixed = !element.fixed"
                        aria-hidden="true"
                    ></i>
                    <div v-if="movable">
                        <a :href="'/edit-contact/' + element.profile_id + '/' + element.slug" :style="{color: element.color, backgroundColor: element.backgroundColor}" class="contact-button">
                            <div class="contact-logo">
                                <img style="width:20px" class="contact-logo-img" :src="element.logo" alt="">
                            </div>
                            <div class="contact-text">
                                <div class="contact-text-top">{{ element.title_button}}</div>
                                <div class="contact-text-bottom">{{ element.text}}</div>
                            </div>
                        </a>
                    </div>
                    <div v-else>
                        <a :href="element.echo_link" :style="{color: element.color, backgroundColor: element.backgroundColor}" class="contact-button">
                            <div class="contact-logo">
                                <img style="width:20px" class="contact-logo-img" :src="element.logo" alt="">
                            </div>
                            <div class="contact-text">
                                <div class="contact-text-top">{{ element.title_button}}</div>
                                <div class="contact-text-bottom">{{ element.text}}</div>
                            </div>
                        </a>
                    </div>
                </li>
            </transition-group>
        </draggable>
    </div>
</template>

<script>
    import draggable from "vuedraggable";

    export default {
        display: "Transitions",
        order: 7,
        components: {
            draggable
        },
        props: [ 'movable', 'contacts' ],
        data() {
            return {
                list: this.contacts.map((contact, index) => {

                    let echo_link = contact.main_link + contact.pivot.link;

                    let title_button = contact.title;
                    let  text = contact.title;

                    if (contact.pivot.text) {
                        title_button = contact.pivot.text;
                    }

                    if (contact.pivot.link) {
                        text = contact.pivot.link;
                    }

                    return {
                        id: contact.id,
                        color: contact.color,
                        logo: '/' + contact.logo,
                        type: contact.type,
                        title: contact.title,
                        backgroundColor: contact.background_color,

                        main_link: contact.main_link,
                        main_text: contact.main_text,

                        link: contact.pivot.link,
                        text: text,

                        order: index + 1,
                        profile_id: contact.pivot.profile_id,
                        contact_id: contact.pivot.contact_id,
                        slug: contact.pivot.slug,
                        echo_link: echo_link,
                        title_button: title_button,
                    };

                }),
                drag: false,
            };
        },
        methods: {
            sendOrders() {

                if (this.movable) {
                    axios.post('/contacts/' + this.list[0].profile_id, this.list)
                        .then(function (response) {
                            this.list = response.data;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            sort() {
                this.list = this.list.sort((a, b) => a.order - b.order);
            },
        },
        computed: {
            dragOptions() {
                return {
                    animation: 200,
                    group: "description",
                    disabled: !this.movable,
                    ghostClass: "ghost"
                };
            }
        },
    };
</script>

<style>
    .button {
        margin-top: 35px;
    }
    .flip-list-move {
        transition: transform 0.5s;
    }
    .no-move {
        transition: transform 0s;
    }
    .ghost {
        opacity: 0.5;
        background: #c8ebfb;
    }
    .list-group {
        min-height: 20px;
    }
    .list-group-item {
        border: none;
        padding: 0;
        cursor: move;
    }

    .list-group-item a {
        cursor: move;
    }

    .show-page .list-group-item a {
        cursor: pointer;
    }

    .list-group-item i {
        cursor: pointer;
    }
</style>
