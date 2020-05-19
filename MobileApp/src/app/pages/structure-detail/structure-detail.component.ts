import { Component, OnInit, ElementRef, ViewChild, AfterViewInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {RetrieverService} from '../../services/retriever.service';
import {Structure} from '../../models/class/structure';
import {HttpClient} from '@angular/common/http';
import {AuthService} from '../../services/auth.service';
declare var google;

@Component({
  selector: 'app-structure-detail',
  templateUrl: './structure-detail.component.html',
  styleUrls: ['./structure-detail.component.scss'],
})
export class StructureDetailComponent implements OnInit, AfterViewInit {
  structure: Structure;
  error: any = false;
  map: any;
  @ViewChild('map', {static: true}) mapElement; 

  constructor(private activatedRoute: ActivatedRoute,
              private rtrService: RetrieverService, private router: Router, 
              private authService: AuthService
              ) {
    activatedRoute.params.subscribe(params => {
      if (params.id) {
        this.rtrService.structureDetail(params.id).subscribe((struttura) => {
          this.structure = struttura;
          this.showMap();

        }, (err) => {
          this.error = true;
        });
      }
    });
  }

  showReviews(): boolean {
    return this.authService.isAuthenticated();
  }

  ngOnInit() {}

  ngAfterViewInit() {
  }

  goToStructure(): void {
    this.router.navigateByUrl('');
  }

  showMap() {
    let latLng = new google.maps.LatLng(this.structure.latitude, this.structure.longitude);

    let mapOptions = {
        center: latLng,
        zoom: 15,
        draggable: false
    };

    this.map = new google.maps.Map(this.mapElement.nativeElement, mapOptions);

    let marker = new google.maps.Marker({
        map: this.map,
        animation: google.maps.Animation.DROP,
        position: latLng
    });
  }
}


