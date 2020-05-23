<template>
    <div>
        <select name="" id="" v-model="selected_hero_id">
            <option v-for="hero in heroes" v-bind:value="hero.id">{{ hero.name }}</option>
        </select>
        {{ selected_hero_id }}
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            heroes: [],
            url: 'http://localhost/counter-picker/public',
            selected_hero_id: 0
        }
    },

    mounted(){
        this.fetchHeroes();
    },

    methods: {
        fetchHeroes(){
            axios.get(this.url + '/heroes')
            .then(res => {
                this.heroes = res.data;
            })
            .catch(errors => console.log(errors));
        }
    },
}
</script>