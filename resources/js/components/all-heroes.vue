<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>    
    </div>

    <div class="form-group">
        <input type="text" class="form-control" v-model="search">
    </div>

    <div v-if="toggleHeroView == false" class="d-flex align-content-around flex-wrap">
        <div style="width: 150px;" v-for="hero in filteredHeroes" class="m-2 p-2 bd-highlight bg-info" @click="getCountersForSelectedHero(hero)">{{ hero.name }}</div>
    </div>

    <div v-if="toggleHeroView == true">
        <div class="mb-4">{{hero.name}}</div>

        <div class="d-flex align-content-around flex-wrap">
            <div style="width: 150px;" v-for="h in listOfCounterHeroes" class="m-2 p-2 bd-highlight bg-info" >{{ h.name }}</div>
            <div style="width: 150px;" class="m-2 p-2 bd-highlight bg-info text-center" @click="addCounterHero()">+</div>
        </div>
    </div>

    </div>
</template>

<script>
export default {
    data: function(){
        return{
            toggleHeroView: false,
            hero: {},
            search:'',
            heroes: [],
            url: 'http://localhost/counter-picker/public',
            selected_hero_id: 0,
            selected_heroes: [],
            counterHeroes: [],
            listOfCounterHeroes: []
        }
    },
    mounted(){
        this.getAllHeroes()
    },
    computed:{
        filteredHeroes(){
            return this.heroes.filter((hero) => {
                return hero.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    },
    methods: {
        getAllHeroes(){
        axios.get(this.url + '/get_all_heroes_details')
            .then(res => {
                this.heroes = res.data;
                console.log(this.heroes[0].name);
            })
            .catch(errors => console.log(errors));
        },
        getCountersForSelectedHero(hero){
            axios.post(this.url + '/get_counters_for_selected_hero',{
                data: hero.id
            })
            .then(res => {
                this.listOfCounterHeroes = res.data;
                console.log(this.listOfCounterHeroes[0].name);
            })
            .catch(errors => console.log(errors));
            this.toggleHeroView = true;
        },
    }
}
</script>