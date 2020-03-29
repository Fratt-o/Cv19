import {Component, Output, EventEmitter, OnInit} from '@angular/core';
import {ModalController, NavController} from '@ionic/angular';
import {NgForm} from '@angular/forms';
import {Caratteristica, EnumCategorie, FilterModel, RetrieverService, TipoCategoria} from '../../services/retriever.service';
import {FilterService} from './filter.service';

@Component({
  selector: 'app-filters',
  templateUrl: './filters.component.html',
  styleUrls: ['./filters.component.scss'],
})
export class FiltersComponent implements OnInit{

  categoria: TipoCategoria;
  categoriaSelezionata: any;
  caratteristiche: Caratteristica[];
  caratteristicheSelezionate: number[] = [];
  categorie = [
    {
      label: EnumCategorie.Ristorante,
      icon: 'restaurant-outline'
    },
    {
      label: EnumCategorie.Hotel,
      icon: 'bed-outline'
    },
    {
      label: EnumCategorie.Attrazioni,
      icon: 'earth-outline'
    },
  ];

  constructor(private modalController: ModalController,
              private navCtrl: NavController,
              private filterService: FilterService,
              private rtrService: RetrieverService) {}

  ngOnInit(): void {
    this.rtrService.getCaratteristiche().subscribe((caratteristiche) => {
      this.caratteristiche = caratteristiche;
    });


    if (this.filterService.hasFilter()) {
      const filter = this.filterService.getFilter();
      this.categoria = filter.categoria;
      this.caratteristicheSelezionate.push(...filter.caratteristiche);
    }
  }


  toggleCaratteristica(event: CustomEvent, idCaratteristica: number) {
    if (event.detail.checked) {
      this.caratteristicheSelezionate.push(idCaratteristica);
    } else {
      const indiceCaratteristica = this.caratteristicheSelezionate.indexOf(idCaratteristica);
      if (indiceCaratteristica !== -1) {
        // Splice permette di eliminare un range di elementi a partire da un indice
        // Indichiamo che vogliamo eliminare 1 solo elemento a partire da indiceCaratteristica
        this.caratteristicheSelezionate.splice(indiceCaratteristica, 1);
      }
    }
  }

  impostaCategoria(event: CustomEvent) {
    this.categoria = event.detail.value;
  }

  sendFilters(): any {
    const filterModel: FilterModel = {
      categoria: this.categoria,
      caratteristiche: this.caratteristicheSelezionate
    };
    this.filterService.saveFilter(filterModel);
    this.modalController.dismiss({
      confirmed: true,
      filterModel
    });
  }

  resetFilters(): any {
    this.filterService.removeFilter();
    this.modalController.dismiss({
      confirmed: true,
      filterModel: {}
    });
  }

  isInCaratteristicheSelezionate(idCaratteristica: number): boolean {
    return this.caratteristicheSelezionate.includes(idCaratteristica);
  }
}
