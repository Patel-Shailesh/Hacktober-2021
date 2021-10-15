def dfs_visit(node,t):
	for i in graph[node]:
		if visited[int(i)-1]==False:
			visited[int(i)-1]=True
			t+=1
			time[int(i)-1]=t
			print(node,":",i)
			dfs_visit(i,t)

def dfs(S,t):
	visited[int(S)-1]=True
	t+=1
	time[int(S)-1]=t
	for i in graph[S]:
		if visited[int(i)-1]==False:
			visited[int(i)-1]=True
			t+=1
			time[int(i)-1]=t
			print(S,":",i)
			dfs_visit(i,t)

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
	graph[u].append(v)                   #generate directed graph
S=input("enter starting point")
dfs(S,t)
print(time)