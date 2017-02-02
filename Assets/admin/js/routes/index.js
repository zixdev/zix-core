import Pages from './pages';
import System from './system';

const CoreRoutes = [
    ...Pages,
    ...System
];
Zexus.routes.push(...CoreRoutes);