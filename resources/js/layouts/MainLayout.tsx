import type { PropsWithChildren } from 'react';

export default function MainLayout({ children }: PropsWithChildren) {
    return <div className={"container mx-auto px-4"}>{children}</div>
}
