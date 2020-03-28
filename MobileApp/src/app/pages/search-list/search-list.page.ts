import {Component, OnInit, ViewChild} from '@angular/core';
import { RetrieverService} from '../../services/retriever.service';
import {Router} from '@angular/router';
import { Structure } from '../../models/structure';
import {IonInfiniteScroll} from '@ionic/angular';
import {environment} from '../../../environments/environment';


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

  constructor(private rtrService: RetrieverService,
              private router: Router) { }

  ngOnInit() {
    this.retriveMoreAttractions(environment.numAttractionsToRetrieve, this.currentPage).subscribe((luoghi) => {
      this.luoghiMostrati.push(...luoghi);
    });
  }

  cercaLuogo(nomeLuogo: string): void {
    this.rtrService.attractionSelector(nomeLuogo).subscribe((struttura) => {
      this.luoghiMostrati = struttura;
    });
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

    this.retriveMoreAttractions(environment.numAttractionsToRetrieve, this.currentPage).subscribe((luoghi) => {
      event.target.complete();
      this.luoghiMostrati.push(...luoghi);

      if (!this.rtrService.hasMoreAttractions) {
        event.target.disabled = true;
      }
    });
    /*
    setTimeout(() => {



      // App logic to determine if all data is loaded
      // and disable the infinite scroll
      if (this.luoghiMostrati.length === this.tuttiLuoghi.length) {
        event.target.disabled = true;
      }
    }, 500);*/
  }

  toggleInfiniteScroll() {
    this.infiniteScroll.disabled = !this.infiniteScroll.disabled;
  }

  retriveMoreAttractionsOld(qty: number) {
    const currentShownAttractions = this.luoghiMostrati.length;
    for (let i = currentShownAttractions; i < qty + currentShownAttractions && i < this.tuttiLuoghi.length; i++) {
      this.luoghiMostrati.push(this.tuttiLuoghi[i]);
    }
  }

  retrieveOnFilter(filter: any) {
    this.luoghiMostrati = [];
    this.retriveMoreAttractions(environment.numAttractionsToRetrieve, 0, filter).subscribe((luoghi) => {
      this.luoghiMostrati.push(...luoghi);
    });
  }


  retriveMoreAttractions(qty: number, page: number, filter?: any) {
    return this.rtrService.getAttractions({
      pagination: {
        page,
        pageSize: qty
      },
      filter
    });
  }
}
