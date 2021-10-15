






# main
graph={}
visited=[]
time=[]
t=0
V=int(input("enter no. of vertex"))
E=int(input("enter no. of edges"))
for i in range(V):
	graph[str(i+1)]=[]
	visited.append(False)
	time.append(0)
for i in range(E):
	u,v=input("enter start and end vertex").split()
	graph[u].append(v)          