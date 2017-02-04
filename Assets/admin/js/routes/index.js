import Pages from './pages';
import System from './system';
import Users from './users';
import Menu from './menu';

const CoreRoutes = [
    ...Pages,
    ...Menu,
    ...Users,
    ...System
];
Zexus.routes.push(...CoreRoutes);