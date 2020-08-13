<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">All Heroes</h1>    
    </div>

    <div v-if="toggleHeroView == false" class="form-group">
        <input type="text" class="form-control" v-model="search">
    </div>

    <div v-if="toggleHeroView == false" class="d-flex align-content-around flex-wrap">
        <div style="width: 200px;" v-for="hero in filteredHeroes" class="m-2 p-2 bd-highlight bg-info" @click="getCountersForSelectedHero(hero)">{{ hero.name }} <div v-if="hero.counter_by_count > 0" class="ml-auto badge badge-secondary">{{ hero.counter_by_count }}</div></div>
    </div>

    <div v-if="toggleHeroView == true">
        
        <div class="h3 mb-4">{{hero.name}}</div>
                
            <div v-for="counterHero in listOfCounterHeroes" class="row w-100">
                <div class="col-sm-10">
                    <v-select
                        label="name"
                        :options="heroes"
                        :value="counterHero.name"
                        @input="selected_counter_hero => selectCounterHero(counterHero ,selected_counter_hero)"
                        ></v-select>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-sm btn-danger" @click="deleteCounterHero(counterHero)">Delete</button>
                </div>
            </div>
            
            <div style="width: 150px;" class="m-2 p-2 bd-highlight bg-info text-center" @click="addHeroToCounters()">+</div>
            <div style="width: 150px;" class="m-2 p-2 bd-highlight bg-info text-center" @click="saveHeroToCounters()">Save</div>
        
        </div>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            counterHero: {},
            toggleHeroView: false,
            hero: {},
            search:'',
            heroes: [],
            url: 'http://localhost/counter-picker/public',
            selected_hero_id: 0,
            selected_heroes: [],
            selected_counter_hero:{},
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
            })
            .catch(errors => console.log(errors));
        },
        getCountersForSelectedHero(hero){
            this.hero = hero;
            axios.post(this.url + '/get_counters_for_selected_hero',{
                data: hero
            })
            .then(res => {
                this.listOfCounterHeroes = res.data;
                this.toggleHeroView = true;
            })
            .catch(errors => console.log(errors));
        },
        addHeroToCounters(){
            this.listOfCounterHeroes.push({
                "hero_id": 0,
                "counterd_by":0,
                "score":0,
                "count":0,
                "created_at":null,
                "updated_at":null,
                "name":""
                })
        },
        selectCounterHero(counterHero ,selected_counter_hero){
            this.addHeroToCounters();
            counterHero.hero_id = this.hero.id;
            counterHero.counterd_by = selected_counter_hero.id;
            counterHero.name = selected_counter_hero.name;
        },
        saveHeroToCounters(){
            axios.post(this.url + '/save_counters_for_selected_hero',{
                data: this.listOfCounterHeroes,
                hero_id: this.hero.id
            })
            .then(res => {
                this.listOfCounterHeroes = res.data;
                this.toggleHeroView = false;
                this.search = '';
            })
            .catch(errors => console.log(errors));
        },
        deleteCounterHero(h){
            axios.post(this.url + '/delete_counters_for_selected_hero',{
                data: h
            })
            .then(res => {
                this.listOfCounterHeroes = res.data;
                this.toggleHeroView = true;
            })
            .catch(errors => console.log(errors));
        }
    }
}
</script>