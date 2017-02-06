import Pages from './pages';
import System from './system';
import Users from './users';
import Menu from './menu';
import Forms from './forms';

const CoreRoutes = [
    ...Pages,
    ...Menu,
    ...Users,
    ...Forms,
    ...System
];
Zexus.routes.push(...CoreRoutes);