import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  { path: '', redirectTo: 'search-list', pathMatch: 'full' },
  { path: 'search-list',
    loadChildren: () => import('./pages/search-list/search-list.module').then(m => m.SearchListPageModule)},
  {
    path: 'access',
    loadChildren: () => import('./authentication/access/access.module').then(m => m.AccessPageModule)
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
