import Pages from './pages';
import System from './system';
import Users from './users';

const CoreRoutes = [
    ...Pages,
    ...Users,
    ...System
];
Zexus.routes.push(...CoreRoutes);