oc new-app https://github.com/bhakareashutosh/myphpapp
oc logs -f buildconfig/myphpapp
oc expose svc myphpapp
oc get route
after updating GIT repo 
oc start-build myphpapp
check the route URL for the changes
