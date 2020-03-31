import {Component, OnInit, ViewChild} from '@angular/core';
import { RetrieverService} from '../../services/retriever.service';
import {Router} from '@angular/router';
import { Structure } from '../../models/class/structure';
import {IonInfiniteScroll} from '@ionic/angular';
import {environment} from '../../../environments/environment';
import {FilterService} from '../filters/filter.service';
import {FilterModel} from '../../models/interfaces/filtermodel';


@Component({
  selector: 'app-search-list',
  templateUrl: './search-list.page.html',
  styleUrls: ['./search-list.page.scss'],
})
export class SearchListPage implements OnInit {
  @ViewChild(IonInfiniteScroll, { static: true }) infiniteScroll: IonInfiniteScroll;
  luoghiMostrati: Structure[] = [];
  tuttiLuoghi: Structure[] = [];

  currentPage = 0;
  isLoading = false;
  constructor(private rtrService: RetrieverService,
              private router: Router, private filterService: FilterService) { }

  ngOnInit() {
    this.retriveAttractions(0);
  }

  cercaLuogo(nomeLuogo: string): void {
    this.luoghiMostrati = [];
    const filter: FilterModel = {
      nome: nomeLuogo
    }
    this.retriveAttractions(0, filter);
    this.filterService.saveFilter(filter);
  }

  goToStructureDetail(id: number): void {
    this.router.navigateByUrl('search-list/details/' + id);
  }

  loadMoreData(event) {
    if (!this.rtrService.hasMoreAttractions) {
      event.target.complete();
      event.target.disabled = true;
      return;
    }
    this.currentPage++;

    const filter = this.filterService.getFilter();
    this.retriveAttractions(this.currentPage, filter, () => {
      // Nasconde il loader della paginazione
      event.target.complete();
      if (!this.rtrService.hasMoreAttractions) {
        // Disabilita la paginazione
        event.target.disabled = true;
      }
    });
  }

  retrieveOnFilter(filter: any) {
    this.luoghiMostrati = [];
    this.retriveAttractions(0, filter);
  }


  retriveAttractions(page: number, filter?: any, cb?: () => void) {
    this.isLoading = true;
    this.rtrService.getAttractions({
      pagination: {
        page,
        pageSize: environment.numAttractionsToRetrieve
      },
      filter
    }).subscribe((luoghi) => {
      setTimeout(() => {
        this.isLoading = false;
        this.luoghiMostrati.push(...luoghi);
      }, 800);
      if (cb) {
        cb();
      }
    }, () => {
      this.isLoading = false;
    });
  }
}
