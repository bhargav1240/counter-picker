<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">All Heroes</h1>    
    </div>

    <div class="form-group">
        <input type="text" class="form-control" v-model="search">
    </div>

    <div v-if="toggleHeroView == false" class="d-flex align-content-around flex-wrap">
        <div style="width: 150px;" v-for="h in filteredHeroes" class="m-2 p-2 bd-highlight bg-info" @click="selectHero(h)">{{ h.name }}</div>
    </div>

    <div v-if="toggleHeroView == true">
        <div class="mb-4">{{selectedHero.name}}</div>

        <div class="d-flex align-content-around flex-wrap">
            <div style="width: 250px;" v-for="counterHero in listOfCounterHeroes" class="m-2 p-2 bd-highlight bg-info" >
                {{ counterHero.name }}
                <v-select
                    label="name"
                    :options="heroes"
                    :value="counterHero.name"
                    @input="setSelected(counterHero)"
                    ></v-select>
            </div>
            <div style="width: 150px;" class="m-2 p-2 bd-highlight bg-info text-center" @click="addHeroToCounters()">+</div>
            <div style="width: 150px;" class="m-2 p-2 bd-highlight bg-info text-center" @click="saveHeroToCounters()">Save</div>
        </div>
    </div>

    </div>
</template>

<script>
export default {
    data: function(){
        return{
            counterHero: {},
            toggleHeroView: false,
            selectedHero: {},
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
                console.log(this.heroes[0].name);
            })
            .catch(errors => console.log(errors));
        },
        selectHero(h){
            this.selectedHero = h;
            axios.post(this.url + '/get_counters_for_selected_hero',{
                data: this.selectedHero.id
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
        setSelected(item){
            item.hero_id = this.hero.id;
            item.counterd_by = this.selected_counter_hero.id;
            item.name = this.selected_counter_hero.name;
        },
        saveHeroToCounters(){
            axios.post(this.url + '/save_counters_for_selected_hero',{
                data: this.listOfCounterHeroes
            })
            .then(res => {

            })
            .catch(errors => console.log(errors));
        }
    }
}
</script>