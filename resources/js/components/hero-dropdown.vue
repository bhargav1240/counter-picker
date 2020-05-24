<template>
    <div>
        <div class="row">
            <select name="" id="" v-model="selected_hero_id" @change="onSeelectHero()">
                <option v-for="hero in heroes" v-bind:value="hero.id">{{ hero.name }}</option>
            </select>
        </div>
        
        <div class="row">
            <ul>
                <li v-for="c in counterHeroes">{{ c.name }}
                    <ul>
                        <li>{{ c.score }}</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            heroes: [],
            url: 'http://localhost/counter-picker/public',
            selected_hero_id: 0,
            counterHeroes: []
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
        },
        onSeelectHero(){
            axios.post(this.url + '/on_select_hero',{
                data: this.selected_hero_id
            })
            .then(res => {
                this.counterHeroes = res.data;
            })
            .catch(errors => console.log(errors));
        }
    },
}
</script>